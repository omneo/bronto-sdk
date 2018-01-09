<?php

namespace Arkade\Bronto;

use Illuminate\Support\ServiceProvider;
use Arkade\Bronto;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the config.
        $this->publishes([
            __DIR__ . '/Config/bronto.php' => config_path('bronto.php'),
        ]);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // Setup the rest client auth.
        $this->app->singleton(Bronto\RestAuthentication::class, function(){
            return (new Bronto\RestAuthentication)
                ->setAuthUrl(config('services.bronto.authUrl'))
                ->setEndpoint(config('services.bronto.endpoint'))
                ->setClientId(config('services.bronto.clientId'))
                ->setClientSecret(config('services.bronto.clientSecret'));
        });

        // Setup the rest client.
        $this->app->singleton(Bronto\RestClient::class, function () {
            return (new Bronto\RestClient(resolve(Bronto\RestAuthentication::class)))
                ->setProductsApiId(config('services.bronto.productsApiId'));
        });

        // Setup the soap client
        $this->app->singleton(Bronto\SoapClient::class, function () {
            return (new Bronto\SoapClient())
                ->setToken(config('services.bronto.soapToken'))
                ->setListId(config('services.bronto.listId'));
        });
    }
}
