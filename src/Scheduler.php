<?php

namespace App\Packages\LaravelPlaybooks;


use Dclaysmith\LaravelPlaybooks\Jobs\RunAudiences;
use Dclaysmith\LaravelPlaybooks\Jobs\InsertNextSteps;
use Dclaysmith\LaravelPlaybooks\Jobs\ProcessSteps;
use Dclaysmith\LaravelPlaybooks\Jobs\ProcessActions;

class Scheduler
{    
    
    private $schedule;

    public function __construct(object $schedule) {
        $this->schedule = $schedule;   
    }

    public function run(): void {
        
        // Activates Playbooks
        $this->schedule->job(new RunAudiences)->everyFiveMinutes();

        // See if there are steps that need to be started
        $this->schedule->job(new InsertNextSteps)->everyFiveMinutes();

        // See if there are steps that need to be started
        $this->schedule->job(new ProcessSteps)->everyFiveMinutes();

        // Executes the pending actions
        $this->schedule->job(new ProcessActions)->everyFiveMinutes();
    }
}   