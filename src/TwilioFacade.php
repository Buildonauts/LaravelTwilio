<?php

namespace Buildonauts\LaravelTwilio;

use \Illuminate\Support\Facades\Facade;

class Twilio extends Facade {
    
    protected static function getFacadeAccessor()
    {
        return 'twilio';
    }
    
}