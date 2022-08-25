<?php

namespace ArandaCa;

use ArandaCa\Aranda\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use ArandaCa\Facade\MoebiusDesk;
use ArandaCa\Facade\ServiceDesk;
use ArandaCa\Facade\ServiceDeskFull;
use ArandaCa\Factory\AsaTicket\MoebiusDeskFactory;
use ArandaCa\Factory\AsaTicket\ServiceDeskFactory;
use ArandaCa\Factory\AsaTicket\ServiceDeskFullFactory;
use Illuminate\Cache\CacheManager;

class AsaTicketArandaCaServiceProvider extends ArandaCaServiceProvider
{      
    public function register()
    {        
        parent::register();
        $aranda = app()->make('aranda');      
        
        $this->app->singleton(ServiceDeskFull::class, function() use($aranda) { 
            $webService = new \App\ServiceDeskFull();
            $factory = new ServiceDeskFullFactory($aranda);            

            return new ServiceDeskFull($webService, $aranda, $factory, config('arandaca.service'));       
        });

        $this->app->singleton(ServiceDesk::class, function() use($aranda) { 
            $webService = new \App\ServiceDesk();
            $factory = new ServiceDeskFactory($aranda);            

            return new ServiceDesk($webService, $aranda, $factory, config('arandaca.service'));       
        });

        $this->app->singleton(MoebiusDesk::class, function() use($aranda) { 
            $webService = new \App\MoebiusDesk();
            $factory = new MoebiusDeskFactory($aranda);            

            return new MoebiusDesk($webService, $aranda, $factory, config('arandaca.service'));       
        });
    }       
}
  