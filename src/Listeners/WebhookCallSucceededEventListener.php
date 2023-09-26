<?php

namespace Dclaysmith\LaravelPlaybooks\Listeners;

use Spatie\WebhookServer\Events\WebhookCallSucceededEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class WebhookCallSucceededEventListener
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
     * @param  Spatie\WebhookServer\Events\WebhookCallSucceededEvent  $event
     * @return void
     */
    public function handle(WebhookCallSucceededEvent $event)
    {
        Log::debug(json_encode($event));
    }
}
