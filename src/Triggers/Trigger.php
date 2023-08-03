<?php

namespace Dclaysmith\LaravelPlaybooks\Triggers;

use Illuminate\Database\Eloquent\Builder;

abstract class Trigger
{
    abstract static function builder() : Builder;
    
    abstract static function identifier(object $playbookDefinition, object $triggeredData) : string;
}