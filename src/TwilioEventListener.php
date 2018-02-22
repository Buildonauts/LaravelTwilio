<?php

namespace Buildonauts\LaravelTwilio;

use App\Models\AppLog;
use Log;

class TwilioEventListener
{
    
    public function __construct()
    {
        //
    }
    
    /**
     * Handle Twilio events.
     */
    public function handle(TwilioEvent $event) {
        $arr = (array)$event;
        unset($arr['socket']);
        $action = $arr['action'];
        unset($arr['action']);
        AppLog::addEntry($action,NULL, json_encode($arr));
    }
    
}