<?php

/**
 * Provided as an example
 * Automatically copied to: 
 * /app/Packages/LaravelPlaybooks/Audiences
 */
namespace App\Packages\LaravelPlaybooks\Audiences;

use Dclaysmith\LaravelPlaybooks\Audiences\Audience;
use Illuminate\Database\Eloquent\Builder;

class AllUsersAudience extends Audience
{
    static function builder(): Builder
    {
        return \App\Models\User::query();
    }
}
