<?php

namespace Dclaysmith\LaravelPlaybooks\Webhooks;

use Spatie\WebhookServer\WebhookCall;

use Illuminate\Database\Eloquent\Model;

abstract class Webhook
{
    public $url = "https://webhook.site/0ffee2e9-92ca-43bf-81de-018b29e2414f";

    public $headers;

    public $target;

    public $configuration;

    abstract function payload(): array;

    abstract function headers(): array;

    public function send()
    {
        $result = WebhookCall::create()
            ->url($this->url)
            // ->meta([
            //     "configuration" => $this->configuration,
            //     "target" => $this->target,
            // ])
            ->payload($this->payload())
            ->useSecret("sign-using-this-secret")
            ->dispatchSync();
    }
}
