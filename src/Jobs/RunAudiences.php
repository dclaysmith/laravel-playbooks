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
| RunAudiences
|--------------------------------------------------------------------------
|
| Loop through playbooks with audiences, run audiences and create playbook instances
|
*/

class RunAudiences implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {

        /**
         * Query the items
         */
        $playbookAudiences = \Dclaysmith\LaravelPlaybooks\Models\PlaybookAudience::where(function ($query) {
            $query->whereDate(
                "last_ran_at",
                "<",
                \Carbon\Carbon::now()->subDays(0)
            );
            $query->orWhereNull(
                "last_ran_at"
            );
        })->get();

        Log::debug("Dclaysmith\LaravelPlaybooks\Jobs\RunAudiences - " . $playbookAudiences->count());

        foreach ($playbookAudiences as $playbookAudience) {
            dispatch(new \Dclaysmith\LaravelPlaybooks\Jobs\RunAudience($playbookAudience));

            // Set as synced even if it may fail
            $playbookAudience->last_ran_at = now();
            $playbookAudience->save();
        }
    }
}
