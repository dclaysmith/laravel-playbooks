<?php

namespace App\Packages\LaravelPlaybooks\Conditions;

use Dclaysmith\LaravelPlaybooks\Conditions\Condition;
use Illuminate\Database\Eloquent\Model;

class IsAdminCondition extends Condition
{
    static function check(Model $model): Model
    {
        if ($model->is_admin) {
            return $model;
        }
        return false;
    }
}
