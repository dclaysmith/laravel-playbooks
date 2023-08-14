<?php

return [


    /*
    |--------------------------------------------------------------------------
    | Target Classes
    |--------------------------------------------------------------------------
    |
    | The models that can be added to the playbooks
    |
    */
    "target" => \App\Models\User::class,

    /*
    |--------------------------------------------------------------------------
    | Audiences Directory
    |--------------------------------------------------------------------------
    |
    | The models that can be added to the playbooks
    |
    */
    "audiences_directory" => "../app/Packages/LaravelPlaybooks/Audiences",

    /*
    |--------------------------------------------------------------------------
    | Conditions Directory
    |--------------------------------------------------------------------------
    |
    | The models that can be added to the playbooks
    |
    */
    "conditions_directory" => "../app/Packages/LaravelPlaybooks/Conditions",

    /*
    |--------------------------------------------------------------------------
    | Actions Directory
    |--------------------------------------------------------------------------
    |
    | The models that can be added to the playbooks
    |
    */
    "actions_directory" => "../app/Packages/LaravelPlaybooks/Actions",
    "actions_namespace" => "App\\Packages\\LaravelPlaybooks\\Actions",

    /*
    |--------------------------------------------------------------------------
    | Mailables Directory
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
    "mailables_directory" => "../app/Mail",
    "mailables_namespace" => "App\\Mail",


    /*
    |--------------------------------------------------------------------------
    | Webhooks Directory
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
    "webhooks_directory" => "../app/Packages/LaravelPlaybooks/Webhooks",
    "webhooks_namespace" => "App\\Packages\\LaravelPlaybooks\\Webhooks",
];
