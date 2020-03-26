<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property int|null $user_id 用户id
 * @property string|null $title 文章标题
 * @property string|null $content 文章内容
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', '用户id'),
            'title' => Yii::t('app', '文章标题'),
            'content' => Yii::t('app', '文章内容'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ArticlesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ArticlesQuery(get_called_class());
    }
}
