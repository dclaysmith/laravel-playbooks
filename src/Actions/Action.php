<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

abstract class Action
{

    protected $configuration;

    public function __construct(array $configuration = [])
    {
        $this->configuration = $configuration;
    }

    abstract function do() : void;
}