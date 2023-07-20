<?php

namespace Dclaysmith\LaravelPlaybooks\Triggers;

abstract class Trigger
{
    abstract static function builder() : builder;
    
    abstract static function identifier(object $playbookDefinition, object $triggeredData) : string;
}