<?php

use Illuminate\Support\Facades\Route;

use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\ActionController;
use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\AudienceController;
use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\AudienceDataController;
use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\ConditionController;
use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\PlaybookController;
use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\PlaybookActionController;
use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\PlaybookAudienceController;
use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\PlaybookStepController;
// use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\PlaybookStepActionContr0ller;

Route::middleware("web")->group(function () {
    Route::group(["prefix" => "api"], function () {
        Route::resource("lp-actions", ActionController::class);
        Route::resource("lp-audiences",  AudienceController::class);
        Route::resource("lp-audience-data",  AudienceDataController::class);
        Route::resource("lp-conditions",  ConditionController::class);
        Route::resource("lp-playbooks", PlaybookController::class);
        Route::resource("lp-playbook-actions", PlaybookActionController::class);
        Route::resource("lp-playbook-audiences",  PlaybookAudienceController::class);
        Route::resource("lp-playbook-steps", PlaybookStepController::class);
        // Route::resource("lp-playbook-step-actions", PlaybookStepActionController::class);
    });
});
