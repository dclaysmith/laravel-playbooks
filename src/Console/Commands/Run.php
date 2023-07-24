<?php

namespace Dclaysmith\LaravelPlaybooks\Commands\Console\Commands;

use Illuminate\Console\Command;

class Run extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-playbooks:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Laravel Playbooks Package.';

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
        \Log::debug('PING');

        /**
         * Trigger New Playbooks
         */

        /**
         * Create Playbook Actions
         */

        /**
         * Execute Playbook Actions
         */
    }
}

