<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

use Dclaysmith\LaravelPlaybooks\Actions\Action;

class EndPlaybookAction extends Action
{

    public function do(): void
    {
        \Log::debug('do end playbook');
    }

    public static function definition(): array
    {
        return [];
    }
}
