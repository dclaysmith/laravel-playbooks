<?php

namespace Dclaysmith\LaravelPlaybooks\Jobs;

use Dclaysmith\LaravelPlaybooks\Models\PlaybookAudience;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use Dclaysmith\LaravelPlaybooks\Models\InstanceStep;

/*
|--------------------------------------------------------------------------
| ProcessStep
|--------------------------------------------------------------------------
|
| Execute a Step
|
*/

class ProcessStep implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $instanceStep;

    public function __construct(
        InstanceStep $instanceStep,
    ) {
        $this->instanceStep = $instanceStep;
    }

    public function handle()
    {
        Log::debug("Dclaysmith\LaravelPlaybooks\Jobs\ProcessStep");
    }
}
