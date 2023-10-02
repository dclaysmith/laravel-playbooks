<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Dclaysmith\LaravelPlaybooks\Models\InstanceAction;

abstract class Action
{
    protected $instanceAction;

    protected $target;

    protected $configuration;

    public function __construct(
        InstanceAction $instanceAction,
        ?object $configuration,
        Model $target
    ) {
        $this->instanceAction = $instanceAction;

        $this->configuration = $configuration;

        $this->target = $target;
    }

    abstract function do(): void;

    abstract static function definition(): array;
}
