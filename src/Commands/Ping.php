<?php

namespace App\Packages\LaravelPlaybooks\Commands;

use Illuminate\Console\Command;

class Ping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-playbooks:ping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test LaravelPackages Package.';

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
        echo "PONG";
    }
}
