<?php

namespace Dclaysmith\LaravelPlaybooks\Commands;

use Illuminate\Console\Command;

class RunAudiences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-playbooks:run-audiences';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run any playbooks that should be triggered.';

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
        dispatch(new \Dclaysmith\LaravelPlaybooks\Jobs\RunAudiences());
    }
}
