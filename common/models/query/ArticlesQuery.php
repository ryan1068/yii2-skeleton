<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Articles]].
 *
 * @see \common\models\Articles
 */
class ArticlesQuery extends \yii\db\ActiveQuery
{
    public function userId($userId)
    {
        return $this->andWhere(['user_id' => $userId]);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Articles[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Articles|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
