<?php

namespace ArandaCa;

use ArandaCa\Aranda\Client;
use Illuminate\Support\ServiceProvider;
use ArandaCa\Facade\ServiceDesk;
use ArandaCa\Factory\Panel\ServiceDeskFactory;

class PanelArandaCaServiceProvider extends ArandaCaServiceProvider
{      
    public function register()
    {        
        parent::register();
        $aranda = app()->make('aranda');       

        $this->app->singleton(ServiceDesk::class, function() use($aranda) { 
            $webService = new \App\ServiceDesk();
            $factory = new ServiceDeskFactory($aranda);            

            return new ServiceDesk($webService, $aranda, $factory, config('arandaca.service'));       
        });       
    }       
}
  