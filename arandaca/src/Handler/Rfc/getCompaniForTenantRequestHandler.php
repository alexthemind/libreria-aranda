<?php

namespace ArandaCa\Handler\Rfc;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class getCompaniForTenantRequestHandler implements ArandaCaRequestHandleInterface {

    protected $aranda;

    protected $args;

    protected $library;

    public function __construct(Client $aranda, ArandaCaFacade $library)
    {
        $this->aranda = $aranda;

        $this->args = $library->getArgs();
        
        $this->library = $library;
    }

    public function handle()
    {        
        // Llamar endpoint de proyectos?
        
        return NULL;
    }
    
    public function formatData()
    {
        //
    }
    
    public function formatResponse($data)
    {  
        //           
    }

}