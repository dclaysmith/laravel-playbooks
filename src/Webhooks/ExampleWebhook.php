<?php
/**
 * Provided as an example
 * Automatically copied to: 
 * /app/Packages/LaravelPlaybooks/Webhooks
 */
namespace App\Packages\LaravelPlaybooks\Webhooks;

use Dclaysmith\LaravelPlaybooks\Webhooks\Webhook;

class ExampleWebhook extends Webhook
{
    protected $url = "https://webhook.site/1e5f7ffc-6d9c-46f9-8b86-4473edf5330d";

    protected $headers = 
    [
    ];

    function payload(Model $model)
    {
        return [];
    }
}
