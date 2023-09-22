<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

use Illuminate\Support\Facades\Log;
use Dclaysmith\LaravelPlaybooks\Actions\Action;

class WaitAction extends Action
{

    public function do(): void
    {
        Log::debug('do wait');
    }

    public static function definition(): array
    {
        return [
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
