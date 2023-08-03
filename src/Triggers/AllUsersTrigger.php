<?php

namespace App\Packages\LaravelPlaybooks\Triggers;

use Dclaysmith\LaravelPlaybooks\Triggers\Trigger;
use Illuminate\Database\Eloquent\Builder;

class AllUsersTrigger extends Trigger
{
    static function builder(): Builder
    {
        return \App\Models\User::query();
    }

    static function identifier($playbookDefinition, $triggeredData) : string
    {
        return implode("-", [
            "users",
            data_get($playbookDefinition, "name"),
            data_get($triggeredData, "user_id"),
        ]);
    }
}
