<?php

namespace Botble\EventsPlaces\Providers;

use Botble\EventsPlaces\Listeners\RenderingSiteMapListener;
use Botble\Theme\Events\RenderingSiteMapEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        RenderingSiteMapEvent::class => [
            RenderingSiteMapListener::class,
        ],
    ];
}
