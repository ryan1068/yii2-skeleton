<?php

namespace common\behaviors;

use common\components\queue\LogStash;
use smartflow\components\smartflow\SmartFlowJob;
use Yii;
use yii\base\Behavior;
use yii\helpers\VarDumper;
use yii\queue\ErrorEvent;
use yii\queue\Job;
use yii\queue\JobEvent;
use yii\queue\PushEvent;
use yii\queue\Queue;

class QueueLogBehavior extends Behavior
{
    /**
     * @var Queue
     */
    public $owner;
    /**
     * @var bool
     */
    public $autoFlush = true;

    private $_start;

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            Queue::EVENT_AFTER_PUSH => 'afterPush',
            Queue::EVENT_BEFORE_EXEC => 'beforeExec',
            Queue::EVENT_AFTER_EXEC => 'afterExec',
            Queue::EVENT_AFTER_ERROR => 'afterExecError',
        ];
    }

    public function logTable($job) {
        if ($job instanceof SmartFlowJob) {
            return "queue_log_smart_flow";
        }
        //每两个月更换表
        return "queue_log_" . date('Y') . '_' . intval( ceil( intval( date('m') ) /2 ) );
    }

    public function afterPush(PushEvent $event)
    {
        if ($this->except($event->job)) {
            return;
        }

        $log = Yii::$app->mongodb->getCollection($this->logTable($event->job));
        $log->insert([
            'channel' => (string)$event->sender->channel,
            'queue_id' => (string)$event->id,
            'name' => $event->job instanceof Job ? get_class($event->job) : 'mixed data',
            'timeout' => $event->delay,
            'create_time' => time(),
            'create_date' => date('Y-m-d H:i:s'),
            'start_time' => 0,
            'start_date' => '',
            'end_time' => 0,
            'end_date' => '',
            'spending' => 0,
            'status' => 0,
            'message' => '',
            'data' => get_object_vars($event->job),
        ]);
    }

    public function beforeExec(JobEvent $event)
    {
        if ($this->except($event->job)) {
            return;
        }

        $this->_start = microtime(true);
        $log = Yii::$app->mongodb->getCollection($this->logTable($event->job));
        $now = time();
        $log->update(['channel' => (string)$event->sender->channel, 'queue_id' => (string)$event->id], [
            'start_time' => $now,
            'start_date' => date('Y-m-d H:i:s', $now),
        ]);
    }

    public function afterExec(JobEvent $event)
    {
        if ($this->except($event->job)) {
            return;
        }

        $log = Yii::$app->mongodb->getCollection($this->logTable($event->job));
        $queue_log = $log->findOne(['channel' => (string)$event->sender->channel, 'queue_id' => (string)$event->id]);
        if (!$queue_log) {
            return;
        }
        $now = time();
        $log->update(['_id' => $queue_log['_id']], [
            'status' => 1,
            'end_time' => $now,
            'end_date' => date('Y-m-d H:i:s', $now),
            'spending' => microtime(true) - $this->_start,
            'total_spending' => $now - $queue_log['create_time'],
            'message' => 'success',
        ]);
    }

    public function afterExecError(ErrorEvent $event)
    {
        if ($this->except($event->job)) {
            return;
        }

        $log = Yii::$app->mongodb->getCollection($this->logTable($event->job));
        $queue_log = $log->findOne(['channel' => (string)$event->sender->channel, 'queue_id' => (string)$event->id]);
        if (!$queue_log) {
            return;
        }
        $now = time();
        $log->update(['_id' => $queue_log['_id']], [
            'status' => 2,
            'end_time' => $now,
            'end_date' => date('Y-m-d H:i:s', $now),
            'spending' => microtime(true) - $this->_start,
            'total_spending' => $now - $queue_log['create_time'],
            'message' => VarDumper::export($event->error),
        ]);
    }

    /**
     * 排除记录的任务
     * @param $job
     * @return bool
     */
    protected function except($job)
    {
        if ($job instanceof LogStash) {
            return true;
        }

        return false;
    }
}