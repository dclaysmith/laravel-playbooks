<?php

namespace Dclaysmith\LaravelPlaybooks\Listeners;

use Spatie\WebhookServer\Events\WebhookCallFailedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class WebhookCallFailedEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Spatie\WebhookServer\Events\WebhookCallFailedEvent  $event
     * @return void
     */
    public function handle(WebhookCallFailedEvent $event)
    {
        Log::debug(json_encode($event));
    }
}
