<?php

namespace api\models;


use yii\web\IdentityInterface;

class AdminUser extends \common\models\shop\AdminUser implements IdentityInterface
{
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->au_id;
    }

    public function getAuthKey()
    {
        return;
    }

    public function validateAuthKey($authKey)
    {
        return;
    }

    /**
     * Validates password
     *
     * @param  string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return false;
    }
}