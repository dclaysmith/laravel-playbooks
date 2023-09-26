<?php

namespace Dclaysmith\LaravelPlaybooks\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Spatie\WebhookServer\Events\WebhookCallSucceededEvent;
use Spatie\WebhookServer\Events\WebhookCallFailedEvent;
use Spatie\WebhookServer\Events\FinalWebhookCallFailedEvent;

use Dclaysmith\LaravelPlaybooks\Listeners\WebhookCallSucceededEventListener;
use Dclaysmith\LaravelPlaybooks\Listeners\WebhookCallFailedEventListener;
use Dclaysmith\LaravelPlaybooks\Listeners\FinalWebhookCallFailedEventListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        WebhookCallFailedEvent::class => [
            WebhookCallFailedEventListener::class,
        ],
        WebhookCallSucceededEvent::class => [
            WebhookCallSucceededEventListener::class,
        ],
        FinalWebhookCallFailedEvent::class => [
            FinalWebhookCallFailedEventListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
