<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VoteEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $votes;

    /**
     * Create a new event instance.
     *
     * @param array $votes
     */
    public function __construct($votes)
    {
        $this->votes = $votes;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [new Channel('votes')];
    }

    public function broadcastWith(): array
    {
        return [
            'votes' => $this->votes,
        ];
    }

    public function broadcastAs(): string
    {
        return 'vote.updated';
    }
}
