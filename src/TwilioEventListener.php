<?php

namespace Buildonauts\LaravelTwilio;

use App\Models\AppLog;
use Log;

class TwilioEventListener
{
    /**
     * Handle Twilio events.
     */
    public function TwilioEvent($event) {
        $arr = (array)$event;
        unset($arr['socket']);
        $action = $arr['action'];
        unset($arr['action']);
        AppLog::addEntry($action,NULL, json_encode($arr));
    }
    
    
    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\TwilioEvent',
            'Buildonauts\LaravelTwilio\TwilioEventListener@TwilioEvent'
        );

//        $events->listen(
//            'Illuminate\Auth\Events\Logout',
//            'App\Listeners\UserEventSubscriber@onUserLogout'
//        );
        //dd($events);
        
    }
    
}