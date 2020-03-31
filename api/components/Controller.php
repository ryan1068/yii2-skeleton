<?php
namespace api\components;


use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\web\Response;

class Controller extends \yii\rest\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'verbFilter' => [
                'class' => VerbFilter::class,
                'actions' => $this->verbs(),
            ],
        ];
    }
}