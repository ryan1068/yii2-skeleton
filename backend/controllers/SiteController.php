<?php
namespace backend\controllers;

use backend\components\Controller;
use backend\models\search\ArticlesSearch;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;


/**
 * Site controller
 */
class SiteController extends Controller
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => HttpBearerAuth::class,
            ]
        ]);
    }

    public function actionIndex()
    {
        return [
            'user' => 'abc'
        ];
    }

    public function actionArticles()
    {
        $user = Yii::$app->user->identity;
        $model = new ArticlesSearch();
        $model->userId = $user->getId();
        $model->load(Yii::$app->request->get(), '');
        if (!$model->validate()) {
            return $model;
        }

        return $model->search();
    }
}
