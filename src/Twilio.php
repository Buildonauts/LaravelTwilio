<?php

namespace Buildonauts\LaravelTwilio;

use Twilio\Rest\Client;
use Twilio\Twiml;
use Log;

class Twilio {
    
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
        
        event(new TwilioEvent('sms',$to,$message));
        
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
        
        event(new TwilioEvent('call',$to,$message));
        
    }
    
    public function get() {
        return $this->twilio;
    }

}