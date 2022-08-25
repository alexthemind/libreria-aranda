<?php

namespace ArandaCa\Handler\Rfc\CMDBService;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class doQueryRequestHandler implements ArandaCaRequestHandleInterface {

    protected $aranda;

    protected $args;

    public const OWNED_RESOURCE = "nr";
    public const FAMILY = "nrf";
    public const ITEM_CLASS = "grc";
    public const MODEL = "mfrmod";
    public const COMPANY = "ca_cmpny";
    public const GROUPS = "grp";
    public const GROUP_MEMBER = "grpmem";
    public const TENANT = "tenant";
    public const CATEGORIES = "chgcat";
    public const CONTACT = "cnt";
    public const ORGANIZATION = "org";
    public const AGENTE = "agt";
    public const POSITION = "position";

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
            case self::CATEGORIES:
                return (new categoriesRequestHandler($this->aranda, $this->args))->handle();
                break;                       
            default:
                return [];
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