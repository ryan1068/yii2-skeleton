<?php

namespace backend\models\search;


use backend\resources\Articles;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ArticlesSearch extends Model
{
    public $title;
    public $userId;

    public function rules()
    {
        return [
            [['title'], 'string'],
            [['userId'], 'integer'],
        ];
    }

    public function search()
    {
        $query = Articles::find()->userId($this->userId);

        $query->andFilterWhere(['title' => $this->title]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy(['created_at' => SORT_DESC])
        ]);
        if (!$this->validate()) {
            $query->where('0=1');
        }
        return $dataProvider;
    }
}