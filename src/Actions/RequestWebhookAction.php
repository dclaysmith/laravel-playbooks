<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

use Illuminate\Support\Facades\Log;
use Dclaysmith\LaravelPlaybooks\Actions\Action;

/*
 * https://github.com/spatie/laravel-webhook-server
 */

class RequestWebhookAction extends Action
{

    public function do(): void
    {
        Log::debug('do request webhook action');
    }

    public static function definition(): array
    {
        return [
            [
                "key" => "webhook",
                "type" => "select",
                "label" => "Webhook",
                "options" => self::webhooks(),
                "attributes" => [
                    "required" => true,
                ]
            ],
        ];
    }

    public static function webhooks(): array
    {
        $webhooksDirectory = config(
            "laravel-playbooks.webhooks_directory"
        );

        if (!file_exists($webhooksDirectory)) {
            return [];
        }

        $webhooks = [];
        foreach (new \DirectoryIterator($webhooksDirectory) as $file) {
            if ($file->isFile()) {
                $className = str_replace(".php", "", $file->getFilename());
                $namespaced = config(
                    "laravel-playbooks.webhooks_namespace"
                ) . "\\" . $className;
                $webhooks[] = (object) [
                    "value" => $namespaced,
                    "label" => str_replace(".php", "", $file->getFilename())
                ];
            }
        }

        return $webhooks;
    }
}
