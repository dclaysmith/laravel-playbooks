<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

use Dclaysmith\LaravelPlaybooks\Actions\Action;

class WaitAction extends Action
{

    public function do(): void
    {
    }

    public static function definition(): object
    {
        return (object) [
            [
                "key" => "delay",
                "type" => "number",
                "label" => "How many days?",
                "attributes" => [
                    "required" => true,
                    "min" => 1,
                    "step" => 1
                ]
            ],
        ];
    }
}
