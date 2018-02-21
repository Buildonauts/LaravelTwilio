<?php

return [
    // Your Twilio Account SID #
    'sid' => env('TWILIO_SID') ?: '',
    // Access token that can be found in your Twilio dashboard
    'token' => env('TWILIO_TOKEN') ?: '',
    // The Phone number registered with Twilio that your SMS & Calls will come from
    'from' => env('TWILIO_FROM') ?: '',
    //    | Allows the client to bypass verifying Twilio's SSL certificates.
    //    | It is STRONGLY advised to leave this set to true for production environments
    'ssl_verify' => true,
];