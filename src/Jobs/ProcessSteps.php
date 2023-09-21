<?php

namespace Dclaysmith\LaravelPlaybooks\Jobs;

use Dclaysmith\LaravelPlaybooks\Models\PlaybookAudience;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Query\JoinClause;

use Dclaysmith\LaravelPlaybooks\Models\Instance;

/*
|--------------------------------------------------------------------------
| ProcessSteps
|--------------------------------------------------------------------------
|
| Process a single audience
|
*/

class ProcessSteps implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        /**
         * Query the items
         */
        $instanceSteps = \Dclaysmith\LaravelPlaybooks\Models\InstanceStep::where(
            "status_id",
            \Dclaysmith\LaravelPlaybooks\Models\InstanceStep::STATUS_PENDING
        )->get();

        Log::debug("Dclaysmith\LaravelPlaybooks\Jobs\ProcessSteps - " . $instanceSteps->count());

        foreach ($instanceSteps as $instanceStep) {

            dispatch(new \Dclaysmith\LaravelPlaybooks\Jobs\ProcessStep($instanceStep));
        }
    }
}
