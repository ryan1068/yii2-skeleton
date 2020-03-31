<?php
namespace api\controllers;

use api\components\Controller;
use api\models\search\UserSearch;
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

    public function actionUsers()
    {
        $user = Yii::$app->user->identity;
        $model = new UserSearch();
        $model->area_id = $user->a_areaId;
        $model->load(Yii::$app->request->get(), '');
        if (!$model->validate()) {
            return $model;
        }

        return $model->search();
    }
}
