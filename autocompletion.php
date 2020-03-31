<?php

/**
 * 用于增强IDE代码自动完成。
 * 使用方式：右键(vendor/yiisoft/yii2/Yii.php) -> "Mark as Plain Text"
 */
class Yii extends \yii\BaseYii
{
    /**
     * @var BaseApplication|WebApplication|ConsoleApplication the application instance
     */
    public static $app;
}

/**
 * Class BaseApplication
 * Used for properties that are identical for both WebApplication and ConsoleApplication
 *
 * @property yii\db\Connection $db
 * @property yii\db\Connection $wdb
 * @property yii\db\Connection $qdb
 * @property yii\db\Connection $car
 * @property yii\db\Connection $shop
 * @property yii\db\Connection $tongji
 * @property yii\db\Connection $tool
 * @property yii\db\Connection $thirdDB
 * @property yii\db\Connection $bkdb
 * @property yii\db\Connection $zd_sf
 * @property yii\mongodb\Connection $mongodb
 * @property \yii\queue\Queue $queue
 * @property \yii\queue\Queue $materialQueue
 * @property \yii\queue\Queue $groupSendQueue
 * @property \yii\queue\Queue $exportExcelQueue
 * @property \yii\queue\Queue $thirdPartyQueue
 * @property \yii\queue\Queue $batchAssignQueue
 * @property \yii\queue\Queue $logStashQueue
 * @property \yii\queue\Queue $imQueue
 * @property \yii\queue\Queue $taskLogQueue
 * @property yii\httpclient\Client $http
 * @property yii\redis\Mutex $mutex
 */
abstract class BaseApplication extends yii\base\Application
{
}

/**
 * Class WebApplication
 * Include only Web application related components here
 *
 * @property User $user
 */
class WebApplication extends yii\web\Application
{
}

/**
 * Class ConsoleApplication
 * Include only Console application related components here
 */
class ConsoleApplication extends yii\console\Application
{
}

/**
 * @property \api\resources\AdminUser|yii\web\IdentityInterface|null $identity
 */
class User extends \yii\web\User
{

}