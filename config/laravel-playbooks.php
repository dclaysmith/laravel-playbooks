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
];