<?php

namespace App\Packages\LaravelPlaybooks\Actions;

use Dclaysmith\LaravelPlaybooks\Actions\Action;

class CustomAction extends Action
{

    public function do(): void
    {
        \Log::debug('do custom action');
    }

    public static function definition(): array
    {
        return [];
    }
}
