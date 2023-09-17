<?php

namespace App\Listeners;

use App\Events\VenueDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class VenueDeletedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VenueDeleted $event): void
    {
        info('VenueDeletedNotification', [$event->venue]);
    }
}
