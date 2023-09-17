<?php

namespace App\Listeners;

use App\Events\VenueCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class VenueCreatedNotification
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
    public function handle(VenueCreated $event): void
    {
        info('VenueCreatedNotification', [$event->venue]);
    }
}
