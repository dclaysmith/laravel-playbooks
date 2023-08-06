<?php

namespace Dclaysmith\LaravelPlaybooks\Conditions;

use Illuminate\Database\Eloquent\Model;

abstract class Condition
{
    abstract static function check(Model $model): Model;
}
