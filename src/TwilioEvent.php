<?php

namespace Buildonauts\LaravelTwilio;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TwilioEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $action;
    public $to;
    public $message;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($action, $to, $message)
    {
        //
        $this->action = $action;
        $this->to = $to;
        $this->message = $message;
    
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
     */
}
