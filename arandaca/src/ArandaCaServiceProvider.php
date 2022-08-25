<?php

namespace ArandaCa;

use ArandaCa\Aranda\Client;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ArandaCaServiceProvider extends ServiceProvider
{
    public function boot()
    {        
        $this->mergeConfigFrom(
            __DIR__ . '/config/arandaca.php',
            'aradanca'
        );
        $this->publishes([
            __DIR__ . '/config/arandaca.php' => config_path('arandaca.php')
        ]);
    }

    public function register()
    {     
        $this->app->singleton('aranda', function() { 
            $httpClient = new \GuzzleHttp\Client();
            $aranda = new Client(config('arandaca.aranda.uri'), $httpClient);
            // $cache = new CacheManager(app());

            // if (! $cache->get('arandaToken')) {
                $aranda->auth([
                    'userName' => config('arandaca.aranda.username'),
                    'password' => config('arandaca.aranda.password'),
                    'consoleType' => 1,
                    'providerId' => 0
                ]);
            //     $cache->put('arandaToken', $aranda->getToken(), 1);                
            // } else {
            //     $aranda->setToken($cache->get('arandaToken'));
            // }
            return $aranda;    
        });        
    }
}
