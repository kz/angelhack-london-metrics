<?php

namespace Metrics\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Metrics\Idol\Idol;

class IdolServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app['idol'] = $this->app['Metrics\Idol\Idol'] = $this->app->share(function($app)
        {
            $config = $app['config']->get('services.idol');
            $guzzle = $app['guzzle'];
            return new Idol($guzzle, $config);
        });

        $this->app['guzzle'] = $this->app[Client::class] = $this->app->share(function()
        {
            return new Client(
                [
                    'base_url' => [
                        'https://api.idolondemand.com/{version}/api/',
                        ['version' => '1']
                    ]
                ]
            );
        });
    }

}