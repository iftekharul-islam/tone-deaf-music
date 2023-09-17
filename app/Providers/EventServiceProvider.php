<?php

namespace App\Providers;

use App\Events\VenueCreated;
use App\Events\VenueDeleted;
use App\Events\VenueUpdated;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\VenueCreatedNotification;
use App\Listeners\VenueDeletedNotification;
use App\Listeners\VenueUpdatedNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        VenueCreated::class => [
            VenueCreatedNotification::class,
        ],
        VenueUpdated::class => [
            VenueUpdatedNotification::class,
        ],
        VenueDeleted::class => [
            VenueDeletedNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
