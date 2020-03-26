<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=192.168.2.240;port=5306;dbname=4s_wx_db',
            'username' => 'root',
            'password' => 'allen123hjmHJM',
            'charset' => 'utf8',
        ],
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://192.168.2.240:11707/mydatabase',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '10.10.1.67',
            'port' => 5379,
            'database' => 0,
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
