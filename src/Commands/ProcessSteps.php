<?php

namespace Dclaysmith\LaravelPlaybooks\Commands;

use Illuminate\Console\Command;

class ProcessSteps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-playbooks:process-steps';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Look for steps that need to be actioned.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dispatch(new \Dclaysmith\LaravelPlaybooks\Jobs\ProcessSteps());
    }
}
