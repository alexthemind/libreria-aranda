<?php

namespace ArandaCa\Handler\Rfc\ServiceDeskFull;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class doSelectRequestHandler implements ArandaCaRequestHandleInterface {

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
        $type = $this->args[0]['objectType'];

        switch ($type) {
            case 'cr' :
                return (new crDoSelectRequestHandler($this->aranda, $this->library))->handle();
                break;
            case 'chg' :
                return (new crDoSelectRequestHandler($this->aranda, $this->library))->handle();                
                break;            
            default:
                return NULL;
                break;
        }       
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