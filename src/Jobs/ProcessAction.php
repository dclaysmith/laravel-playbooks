<?php

namespace Dclaysmith\LaravelPlaybooks\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use Dclaysmith\LaravelPlaybooks\Models\InstanceAction;

/*
|--------------------------------------------------------------------------
| ProcessAction
|--------------------------------------------------------------------------
|
| Execute an Action
|
*/

class ProcessAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $instanceAction;

    public function __construct(InstanceAction $instanceAction)
    {
        $this->instanceAction = $instanceAction;
    }

    public function handle()
    {
        /**
         * Get the target
         */
        $target = $this->instanceAction->instance->target;

        /**
         * Get the action class name
         */
        $className = $this->instanceAction->playbookAction->action_class_name;

        /**
         * Create an instance of the action
         */
        $action = new $className(
            $this->instanceAction,
            $this->instanceAction->playbookAction->configuration,
            $target
        );

        Log::debug([
            "InstanceAction.id: " . $this->instanceAction->id,
            "Class Name: " . $className,
        ]);

        /**
         * Execute the action
         */
        $action->do();
    }
}
