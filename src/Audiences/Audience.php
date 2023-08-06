<?php

namespace Dclaysmith\LaravelPlaybooks\Audiences;

use Illuminate\Database\Eloquent\Builder;

abstract class Audience
{
    abstract static function builder(): Builder;
}
