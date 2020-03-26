<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\redis\Cache',
            'redis' => 'redis'
        ],
        'http' => [
            'class' => yii\httpclient\Client::class,
            'transport' => 'yii\httpclient\CurlTransport',
        ],
        'queue' => [
            'class' => yii\queue\redis\Queue::class,
            'channel' => 'queue',
            'as log' => common\behaviors\QueueLogBehavior::class,
        ],
        'i18n' => [
            'translations' => [
                'exception*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'yii*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
        ],
    ],
];
