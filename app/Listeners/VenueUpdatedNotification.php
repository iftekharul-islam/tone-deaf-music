<?php

namespace App\Listeners;

use App\Events\VenueUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class VenueUpdatedNotification
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
    public function handle(VenueUpdated $event): void
    {
        info('VenueUpdatedNotification', [$event->venue]);
    }
}
