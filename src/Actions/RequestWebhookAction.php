<?php

namespace Dclaysmith\LaravelPlaybooks\Actions;

use Illuminate\Support\Facades\Log;
use Dclaysmith\LaravelPlaybooks\Actions\Action;
use Spatie\WebhookServer\WebhookCall;

/*
 * https://github.com/spatie/laravel-webhook-server
 */

class RequestWebhookAction extends Action
{
    public function do(): void
    {
        $result = WebhookCall::create()
            ->url("https://webhook.site/0ffee2e9-92ca-43bf-81de-018b29e2414f")
            ->payload(["key" => "value"])
            ->useSecret("sign-using-this-secret")
            ->dispatchSync();
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
                ],
            ],
        ];
    }

    public static function webhooks(): array
    {
        $webhooksDirectory = config("laravel-playbooks.webhooks_directory");

        if (!file_exists($webhooksDirectory)) {
            return [];
        }

        $webhooks = [];
        foreach (new \DirectoryIterator($webhooksDirectory) as $file) {
            if ($file->isFile()) {
                $className = str_replace(".php", "", $file->getFilename());
                $namespaced =
                    config("laravel-playbooks.webhooks_namespace") .
                    "\\" .
                    $className;
                $webhooks[] = (object) [
                    "value" => $namespaced,
                    "label" => str_replace(".php", "", $file->getFilename()),
                ];
            }
        }

        return $webhooks;
    }
}
