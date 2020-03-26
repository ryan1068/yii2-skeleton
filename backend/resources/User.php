<?php

namespace backend\resources;

class Articles extends \common\models\Articles
{
    public function fields()
    {
        return [
            'id',
            'user_id',
            'title',
            'content' => function () {
                return trim($this->content);
            },
        ];
    }
}