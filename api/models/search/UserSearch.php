<?php

namespace api\models\search;


use api\resources\AdminUser;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserSearch extends Model
{
    public $area_id;
    public $name;

    public function rules()
    {
        return [
            [['name'], 'string'],
            [['area_id'], 'integer'],
        ];
    }

    public function search()
    {
        $query = AdminUser::find();

        $query->andFilterWhere(['au_name' => $this->name]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query->orderBy(['created_at' => SORT_DESC])
        ]);
        if (!$this->validate()) {
            $query->where('0=1');
        }
        return $dataProvider;
    }
}