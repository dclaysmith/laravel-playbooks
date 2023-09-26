<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Dclaysmith\LaravelPlaybooks\Models\InstanceAction;

abstract class Action
{
    protected $instanceAction;

    protected $model;

    protected $configuration;

    public function __construct(
        InstanceAction $instanceAction,
        ?object $configuration,
        Model $model
    ) {
        $this->instanceAction = $instanceAction;

        $this->configuration = $configuration;

        $this->model = $model;
    }

    abstract function do(): void;

    abstract static function definition(): array;
}
