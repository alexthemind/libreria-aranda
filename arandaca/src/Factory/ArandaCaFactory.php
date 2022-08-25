<?php

namespace ArandaCa\Factory;

use ArandaCa\Aranda\Client;
use ArandaCa\Handler\LoginRequestHandler;
use ArandaCa\Exception\InvalidMethodException;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;
use ArandaCa\Facade\ArandaCaFacade;

class ArandaCaFactory {

    protected $aranda;

    protected $methods;
    
    public function __construct(Client $aranda)
    {
        $this->aranda = $aranda;
    }

    public function make($method, ArandaCaFacade $library)
    {          
        if (! array_key_exists($method, $this->methods)) {           
            throw new InvalidMethodException("$method is not available");
        }

        $class = $this->methods[$method];

        return new $class($this->aranda, $library);        
    }

    public function setMethod($name, $handler)
    {
        $interfaces = class_implements($handler);       
        if(
            !$interfaces ||
            ($interfaces && !in_array('ArandaCa\Contract\ArandaCaRequestHandleInterface', $interfaces))
         ) {
            throw new InvalidMethodException("$handler is not valid");
        }

        $this->methods[$name] = $handler;
    }
}