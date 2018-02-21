<?php

namespace Buildonauts\LaravelTwilio;

use Twilio\Rest\Client;
use Twilio\Twiml;
use Illuminate\Support\Facades\Log;

class TwilioService {
    
    private $twilio;
    private $twiml;
    public $from;
    
    public function __construct($sid = NULL, $token= NULL, $from = NULL) {
    
        $sid = config('twilio.sid',$sid);
        $token = config('twilio.token',$token);
        $this->from = config('twilio.from',$from);
        try {
            $this->client = new Client($sid, $token);
        } catch (\Exception $e) {
            Log::error($e);
        }
    }
    
    public function sms($to, $message, $from = NULL, $args=[])
    {
        $this->client->messages->create(
        // the number you'd like to send the message to
            $to,
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => $from == NULL ? $this->from : $from,
                // the body of the text message you'd like to send
                'body' => $message
            ]
        );
        
        event(new \App\Events\TwilioEvent('sms',$to,$message));
        
    }
    
    public function call($to,Twiml $response, $from = NULL, $args = [],$message=NULL)
    {
        $args = array_merge($args);
        
        $call = $this->client->calls->create(
            $to, // Call this number
            $from == NULL ? $this->from : $from, // From a valid Twilio number
            [
                'url' => 'https://twimlets.com/echo?Twiml='.urlencode($response),
            ]
        );
        
        event(new \App\Events\TwilioEvent('call',$to,$message));
        
    }
    
    public function get() {
        return $this->twilio;
    }
}

class Twilio
{
    
    protected $client;
    public $from;
    
    public function __construct()
    {
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $this->from = config('services.twilio.from');
        try {
            $this->client = new \Twilio\Rest\Client($sid, $token);
        } catch (\Exception $e) {
            \Debugbar::info($e);
        }
    }
    
    public function sms($to, $message, $from = NULL, $args=[])
    {
        $this->client->messages->create(
        // the number you'd like to send the message to
            $to,
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => $from == NULL ? $this->from : $from,
                // the body of the text message you'd like to send
                'body' => $message
            ],
            $args
        );
        
        event(new \App\Events\TwilioEvent('sms',$to,$message));
        
    }
    
    public function call($to,\Twilio\Twiml $response, $from = NULL, $args = [],$message=NULL)
    {
        $args = array_merge($args);
        
        $call = $this->client->calls->create(
            $to, // Call this number
            $from == NULL ? $this->from : $from, // From a valid Twilio number
            [
                'url' => 'https://twimlets.com/echo?Twiml='.urlencode($response),
            ]
        );
        
        event(new \App\Events\TwilioEvent('call',$to,$message));
        
    }
}