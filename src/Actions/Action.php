<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

use Illuminate\Database\Eloquent\Model;

abstract class Action
{

    protected $model;

    protected $configuration;

    public function __construct(?object $configuration, Model $model)
    {

        // \Log::debug(json_encode($configuration));
        // \Log::debug(json_encode($model));

        $this->configuration = $configuration;

        $this->model = $model;
    }

    abstract function do(): void;

    abstract static function definition(): array;
}
