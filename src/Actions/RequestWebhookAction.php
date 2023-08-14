<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

use Dclaysmith\LaravelPlaybooks\Actions\Action;

/*
 * https://github.com/spatie/laravel-webhook-server
 */

class RequestWebhookAction extends Action
{

    public function do(): void
    {
    }

    public static function definition(): object
    {
        return (object) [
            "mailable" => [
                "type" => "string",
                "label" => "Webhook",
                "options" => RequestWebhookAction::webhooks(),
                "required" => true
            ]
        ];
    }

    public static function webhooks(): array
    {
        $mailablesDirectory = config(
            "laravel-playbooks.webhooks_directory"
        );

        $webhooks = [];
        foreach (new \DirectoryIterator($mailablesDirectory) as $file) {
            if ($file->isFile()) {
                $className = str_replace(".php", "", $file->getFilename());
                $namespaced = config(
                    "laravel-playbooks.webhooks_namespace"
                ) . "\\" . $className;
                $mailables[] = (object) [
                    "className" => str_replace(".php", "", $file->getFilename()),
                    "namespace" => $namespaced,
                ];
            }
        }

        return $webhooks;
    }
}
