<?php

namespace Dclaysmith\LaravelPlaybooks\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class LaravelPlaybooksServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /**
         * Load Migrations to update the database
         */
        $this->loadMigrationsFrom(__DIR__ . "/../../database/migrations");

        /**
         * Load resources used by this package
         */
        $this->publishes(
            [
                __DIR__ . "/../../src/Actions/CustomAction.php" => app_path(
                    "Packages/LaravelPlaybooks/Actions/CustomAction.php"
                ),
                __DIR__ . "/../../src/Audiences/AllUsersAudience.php" => app_path(
                    "Packages/LaravelPlaybooks/Audiences/AllUsersAudience.php"
                ),
                __DIR__ . "/../../src/Conditions/IsAdminCondition.php" => app_path(
                    "Packages/LaravelPlaybooks/Conditions/IsAdminCondition.php"
                ),
                __DIR__ . "/../../src/Webhooks" => app_path(
                    "Packages/LaravelPlaybooks/Webhooks/ExampleWebhook.php"
                ),
                __DIR__ . "/../../src/Scheduler.php" => app_path(
                    "Packages/LaravelPlaybooks/Scheduler.php"
                ),
            ],
            "components"
        );

        /**
         * Publish Config Directories
         */

        /**
         * Publish Resources
         */

        /**
         * Load Routes
         */
        $this->loadRoutesFrom(__DIR__ . "/../../routes/laravel-playbooks.php");

        /**
         * Publish Config
         */
        $this->publishes(
            [
                __DIR__ . "/../../config/laravel-playbooks.php" => config_path(
                    "laravel-playbooks.php"
                ),
            ],
            "config"
        );

        /**
         * Auto register commands
         */
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Dclaysmith\LaravelPlaybooks\Commands\RunAudiences::class,
                \Dclaysmith\LaravelPlaybooks\Commands\InsertNextSteps::class,
                \Dclaysmith\LaravelPlaybooks\Commands\ProcessSteps::class,
                \Dclaysmith\LaravelPlaybooks\Commands\ProcessActions::class,
            ]);
        }

        if (file_exists(app_path(
            "Packages/LaravelPlaybooks/Scheduler.php"
        ))) {
            $this->app->booted(function () {
                $schedule = $this->app->make(Schedule::class);
                $scheduler = new \App\Packages\LaravelPlaybooks\Scheduler($schedule);
                $scheduler->run();
            });
        }
    }
}
