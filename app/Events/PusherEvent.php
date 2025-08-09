<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class PusherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;

    public function __construct($data = null)
    {
        $this->data = $data;
    }

    public function broadcastOn()
    {
        return new Channel('consolog');
    }

    public function broadcastAs()
    {
        return 'test1';
    }

    public function broadcastWith()
    {
        return [
            'message' =>  $this->data ?? '',
        ];
    }
}
