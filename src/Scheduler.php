<?php

namespace App\Packages\LaravelPlaybooks;

use Dclaysmith\LaravelPlaybooks\Jobs\AddActions;
use Dclaysmith\LaravelPlaybooks\Jobs\RunActions;
use Dclaysmith\LaravelPlaybooks\Jobs\RunAudiences;
use Dclaysmith\LaravelPlaybooks\Jobs\Audience;

class Scheduler
{    
    
    private $schedule;

    public function __construct(object $schedule) {
        $this->schedule = $schedule;   
    }

    public function run(): void {
        
        // Activates Playbooks
        $this->schedule->job(new RunAudiences)->everyFiveMinutes();

        // Adds the next actions to be executed based on the definition
        $this->schedule->job(new AddActions)->everyFiveMinutes();

        // Executes the pending actions
        $this->schedule->job(new RunActions)->everyFiveMinutes();
    }
}   