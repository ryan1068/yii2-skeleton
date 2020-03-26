<?php

namespace common\components\queue;

use yii\base\BaseObject;

/**
 * @package common\components\queue
 */
class SendSms extends BaseObject implements \yii\queue\Job
{
    /**
     * 手机号码
     * @var string
     */
    public $tel;

    /**
     * 发送内容
     * @var string
     */
    public $content;

    /**
     * @param \yii\queue\Queue $queue
     */
    public function execute($queue)
    {
        \Yii::$app->sms->send($this->tel, $this->content);
    }
}