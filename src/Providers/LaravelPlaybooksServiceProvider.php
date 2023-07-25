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
                __DIR__ . "/../../src/Actions" => app_path(
                    "Packages/LaravelPlaybooks/Actions"
                ),
                __DIR__ . "/../../src/Audiences" => app_path(
                    "Packages/LaravelPlaybooks/Audiences"
                ),
                __DIR__ . "/../../src/Commands" => app_path(
                    "Packages/LaravelPlaybooks/Commands"
                ),
                __DIR__ . "/../../src/Triggers" => app_path(
                    "Packages/LaravelPlaybooks/Conditions"
                ),
                __DIR__ . "/../../src/Scheduler.php" => app_path(
                    "Packages/LaravelPlaybooks/Scheduler.php"
                ),
                __DIR__ . "/../../src/Triggers" => app_path(
                    "Packages/LaravelPlaybooks/Triggers"
                ),
            ],
            "components"
        );

        /**
         * Publish Config Directories
         */
        $this->publishes(
            [
                __DIR__ . "/../../resources/playbooks" => app_path(
                    "Packages/LaravelPlaybooks/Triggers"
                ),
            ],
            "config"
        );

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
         * Auto register any commands defined by the user
         */
        if (is_dir(app_path(
            "Packages/LaravelPlaybooks/Commands"
        ))) {
            $commands = array_map(function ($item) {
                return "\\App\\Packages\\LaravelPlaybooks\\Commands\\" . str_replace(".php", "", $item);
            }, preg_grep('/^([^.])/', scandir(app_path(
                "Packages/LaravelPlaybooks/Commands"
            ))));
            $this->commands($commands);
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
