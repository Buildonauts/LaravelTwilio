<?php

namespace Buildonauts\LaravelTwilio;

use Illuminate\Support\ServiceProvider;

class TwilioServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // publish config file
        $this->publishes([
            __DIR__.'/../config/twilio.php' => config_path('twilio.php'),
        ], 'twilio');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TwilioService::class, function ($app) {
            return new TwilioService(config('twilio'));
        });
        
    }
    
    public function provides() {
        return ['mongo'];
    }
}
