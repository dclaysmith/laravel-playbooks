<?php

use Illuminate\Support\Facades\Route;

use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\PlaybooksController;
use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\PlaybookTriggersController;
use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\PlaybookStepsContrller;
use Dclaysmith\LaravelPlaybooks\Http\Controllers\Api\PlaybookStepActionsContrller;

Route::middleware("web")->group(function () {
    Route::group(["prefix" => "api"], function () {
        Route::resource("lp-playbooks", PlaybooksController::class);
        Route::resource("lp-playbook-triggers", PlaybookTriggersContrller::class);
        Route::resource("lp-playbook-steps", PlaybookStepsContrller::class);
        Route::resource("lp-playbook-step-actions", PlaybookStepActionsContrller::class);
    });
});
