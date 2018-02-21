<?php

namespace Buildonauts\LaravelTwilio;

use \Illuminate\Support\Facades\Facade;

class TwilioFacade extends Facade {
    
    protected static function getFacadeAccessor()
    {
        return 'twilio';
    }
    
}