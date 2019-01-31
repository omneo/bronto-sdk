<?php

namespace Omneo\Bronto;

use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {

        // Setup the auth.
        $this->app->singleton(Bronto\RestAuthentication::class, function(){
            return (new Bronto\RestAuthentication)
                ->setAuthUrl(config('services.bronto.authUrl'))
                ->setClientId(config('services.bronto.clientId'))
                ->setClientSecret(config('services.bronto.clientSecret'));
        });

        // Setup the client.
        $this->app->singleton(Bronto\RestClient::class, function () {
            return (new Bronto\RestClient(resolve(Bronto\RestAuthentication::class)));
        });
    }
}
