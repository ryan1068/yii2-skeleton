<?php

namespace backend\resources;

class AdminUser extends \backend\models\AdminUser
{
    public function fields()
    {
        return [
            'id',
            'user_id',
        ];
    }
}