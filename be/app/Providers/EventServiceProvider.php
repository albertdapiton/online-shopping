<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Illuminate\Auth\Events\Registered::class => [
            Illuminate\Auth\Listeners\SendEmailVerificationNotification::class,
        ],
        Laravel\Passport\Events\AccessTokenCreated::class => [
            App\Listeners\RevokeOldTokens::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
