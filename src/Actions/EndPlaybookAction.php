<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

use Illuminate\Support\Facades\Log;
use Dclaysmith\LaravelPlaybooks\Actions\Action;
use Dclaysmith\LaravelPlaybooks\Models\Instance;

class EndPlaybookAction extends Action
{
    public function do(): void
    {
        Log::debug("do end playbook");

        /**
         * Set the instance status_id
         */
        $this->instanceAction->instance->status_id =
            Instance::STATUS_CANCELLED_ACTION;

        $this->instanceAction->instance->save();
    }

    public static function definition(): array
    {
        return [];
    }
}
