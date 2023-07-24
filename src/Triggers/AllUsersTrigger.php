<?php

namespace App\Packages\LaravelPlaybooks\Triggers;

class AllUsersTrigger
{
    static function builder() {
        
        return \App\Models\User::query();
    }
    
    static function identifier($playbookDefinition, $triggeredData) {

        return implode('-', [
            'users',
            data_get($playbookDefinition, "name"),
            data_get($triggeredData, "user_id"),
        ]);
    }
}