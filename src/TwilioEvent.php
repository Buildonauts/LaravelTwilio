<?php

namespace Buildonauts\LaravelTwilio;

class TwilioEvent
{

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

    public function handle( $event) {
        $arr = (array)$event;
        unset($arr['socket']);
        $action = $arr['action'];
        unset($arr['action']);
        AppLog::addEntry($action,NULL, json_encode($arr));
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
