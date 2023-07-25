<?php

use Illuminate\Support\Facades\Route;

use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\PlaybookController;
// use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\PlaybookTriggerController;
// use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\PlaybookStepContrller;
// use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\PlaybookStepActionContrller;

Route::middleware("web")->group(function () {
    Route::group(["prefix" => "api"], function () {
        Route::resource("lp-playbooks", PlaybookController::class);
        // Route::resource("lp-playbook-triggers", PlaybookTriggerContrller::class);
        // Route::resource("lp-playbook-steps", PlaybookStepContrller::class);
        // Route::resource("lp-playbook-step-actions", PlaybookStepActionContrller::class);
    });
});
