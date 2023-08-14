<?php

namespace App\Packages\LaravelPlaybooks\Actions;

use Dclaysmith\LaravelPlaybooks\Actions\Action;

class CustomAction extends Action
{

    public function do(): void
    {
    }

    public static function definition(): object
    {
        return (object) [];
    }
}
