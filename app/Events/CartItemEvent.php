<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CartItemEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data ;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function broadcastOn()
    {
        return new Channel('cart_item_up_event');
    }

    public function broadcastAs()
    {
        return 'message';
    }

    public function broadcastWith()
    {
        return  $this->data ;
    }
}
