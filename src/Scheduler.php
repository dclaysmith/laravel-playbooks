<?php

namespace App\Packages\LaravelPlaybooks;

use Dclaysmith\LaravelPlaybooks\Jobs\AddActions;
use Dclaysmith\LaravelPlaybooks\Jobs\RunActions;
use Dclaysmith\LaravelPlaybooks\Jobs\RunTriggers;
use Dclaysmith\LaravelPlaybooks\Jobs\Trigger;

class Scheduler
{    
    
    private $schedule;

    public function __construct(object $schedule) {
        $this->schedule = $schedule;   
    }

    public function run(): void {
        
        // Activates Playbooks
        $schedule->job(new RunTriggers)->everyFiveMinutes();

        // Adds the next actions to be executed based on the definition
        $schedule->job(new AddActions)->everyFiveMinutes();

        // Executes the pending actions
        $schedule->job(new RunActions)->everyFiveMinutes();
    }
}