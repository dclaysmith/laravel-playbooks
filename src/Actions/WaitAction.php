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
            "delay" => [
                "type" => "number",
                "label" => "Delay in Days",
                "required" => true
            ]
        ];
    }
}
