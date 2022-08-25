<?php

namespace ArandaCa\Facade;

use ArandaCa\Aranda\Client;
use ArandaCa\Factory\ArandaCaFactory;
use ArandaCa\Exception\ServiceNotValidException;
use Artisaninweb\SoapWrapper\Extension\SoapService;

class ArandaCaFacade {

    protected $webService;

    protected $aranda;

    protected $service;

    protected $factory;

    protected $availablesService = [
        'ca',
        'aranda'
    ];

    protected $method;

    protected $args;

    public function __construct(
        $webService, 
        Client $aranda, 
        ArandaCaFactory $factory, 
        $service = 'ca'
    )
    {       
        $this->validateService($service);

        $this->webService = $webService;

        $this->aranda = $aranda;

        $this->service = $service;

        $this->factory = $factory;       
    }

    public function getService()
    {
        return $this->service;
    }

    public function setService($service)
    {
        $this->validateService($service);
       
        $this->service = $service;
    }

    public function getArgs()
    {
        return $this->args;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getWebService()
    {
        return $this->webService;
    }   

    private function validateService($service)
    {
        if (! in_array($service, $this->availablesService)) {
            throw new ServiceNotValidException("'$service' is not valid. Availables services are: " . implode(', ', $this->availablesService) );
        }
    }

    public function __call($method, $args)
    {
        $this->method = $method;

        $this->args = $args;

        if ($this->service === 'ca') {
            return call_user_func_array([$this->webService, $method], $args);
        }

        return $this->factory->make($method, $this)->handle();
    }

}