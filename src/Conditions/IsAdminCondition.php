<?php
/**
 * Provided as an example
 * Automatically copied to:
 * /app/Packages/LaravelPlaybooks/Conditions
 */
namespace App\Packages\LaravelPlaybooks\Conditions;

use Dclaysmith\LaravelPlaybooks\Conditions\Condition;
use Illuminate\Database\Eloquent\Model;

class IsAdminCondition extends Condition
{
    static function check(Model $model): mixed
    {
        if ($model->is_admin) {
            return true;
        }

        return false;
    }
}
