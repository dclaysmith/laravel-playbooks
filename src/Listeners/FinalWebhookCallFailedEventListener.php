<?php

namespace Dclaysmith\LaravelPlaybooks\Listeners;

use Spatie\WebhookServer\Events\FinalWebhookCallFailedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class FinalWebhookCallFailedEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  Spatie\WebhookServer\Events\FinalWebhookCallFailedEvent  $event
     * @return void
     */
    public function handle(FinalWebhookCallFailedEvent $event)
    {
        Log::debug(json_encode($event));
    }
}
