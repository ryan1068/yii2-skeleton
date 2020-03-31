<?php

namespace api\resources;

class AdminUser extends \api\models\AdminUser
{
    public function fields()
    {
        return [
            'id',
            'user_id',
        ];
    }
}