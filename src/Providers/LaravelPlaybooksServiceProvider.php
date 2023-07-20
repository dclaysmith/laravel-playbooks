<?php

namespace Dclaysmith\LaravelPlaybooks\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Dclaysmith\LaravelCms\View\Composers\RenderComposer;

class LaravelPlaybooksServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /**
         * Load Migrations to update the database
         */
        $this->loadMigrationsFrom(__DIR__ . "/../../database/migrations");

        /**
         * Load views created by this package
         */


        /**
         * Publish Trigger Directory
         */
        $this->publishes(
            [
                __DIR__ . "/../../src/Triggers" => app_path(
                    "Packages/LaravelPlaybooks/Triggers"
                ),
            ],
            [
                __DIR__ . "/../../src/Actions" => app_path(
                    "Packages/LaravelPlaybooks/Actions"
                ),
            ],
            "components"
        );

        /**
         * Load Routes
         */
        $this->loadRoutesFrom(__DIR__ . "/../../routes/laravel-cms.php");

        /**
         * Publish Config
         */
        $this->publishes(
            [
                __DIR__ . "/../../config/laravel-cms.php" => config_path(
                    "laravel-cms.php"
                ),
            ],
            "config"
        );

        /**
         * Publish Admin
         */
        $this->publishes(
            [
                __DIR__ . "/../../public/build/" => public_path(
                    "vendor/laravel-cms"
                ),
            ],
            "vue"
        );
        $this->publishes(
            [
                __DIR__ . "/../../resources/admin/dist" => resource_path(
                    "vendor/laravel-cms/admin"
                ),
            ],
            "vue"
        );
    }
}
