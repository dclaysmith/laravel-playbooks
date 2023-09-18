<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

use Dclaysmith\LaravelPlaybooks\Actions\Action;

class TriggerLaravelEventAction extends Action
{

    public function do(): void
    {
    }

    public static function definition(): object
    {
        return (object) [
            [
                "key" => "webhook",
                "type" => "select",
                "label" => "Webhook",
                "options" => RequestWebhookAction::webhooks(),
                "attributes" => [
                    "required" => true,
                ]
            ],
        ];
    }
}
