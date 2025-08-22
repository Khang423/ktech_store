<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class StockExport implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;

    public function __construct($data = null)
    {
        $this->data = $data;
    }

    public function broadcastOn()
    {
        return new Channel('stock_export_update');
    }

    public function broadcastAs()
    {
        return 'message';
    }

    public function broadcastWith()
    {
        return [
            'message' =>  $this->data ?? '',
        ];
    }
}
