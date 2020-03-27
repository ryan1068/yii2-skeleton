<?php

namespace common\models\shop\query;

/**
 * This is the ActiveQuery class for [[\common\models\shop\AdminUser]].
 *
 * @see \common\models\shop\AdminUser
 */
class AdminUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\shop\AdminUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\shop\AdminUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
