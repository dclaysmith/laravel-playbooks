<?php

namespace Dclaysmith\LaravelPlaybooks\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| ProcessActions
|--------------------------------------------------------------------------
|
| Run any actions
|
*/

class ProcessActions implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {

        /**
         * Query the Actions
         */
        $instanceActions = \Dclaysmith\LaravelPlaybooks\Models\InstanceAction::join("lp_instances", "lp_instances.id", "=", "lp_instance_actions.lp_instance_id")
            ->where(
                "lp_instance_actions.status_id",
                \Dclaysmith\LaravelPlaybooks\Models\InstanceAction::STATUS_PENDING
            )->get();

        Log::debug("Dclaysmith\LaravelPlaybooks\Jobs\ProcessActions - " . $instanceActions->count());

        foreach ($instanceActions as $instanceAction) {

            dispatch(new \Dclaysmith\LaravelPlaybooks\Jobs\ProcessAction($instanceAction));
        }
    }
}
