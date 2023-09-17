<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VenueDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $venue;

    /**
     * Create a new event instance.
     */
    public function __construct($venue)
    {
        $this->venue = $venue;
    }
}