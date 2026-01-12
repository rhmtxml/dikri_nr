<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use App\Listeners\MergeCartListener;
use Illuminate\Support\ServiceProvider;
use App\Events\OrderPaidEvent;
use App\Listeners\SendOrderPaidEmail;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
    Login::class => [
        MergeCartListener::class,
    ],
    [App\Events\OrderPaidEvent::class => [
        App\Listeners\SendOrderPaidEmail::class,
    ],
    ]
    ];
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}