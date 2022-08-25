<?php

namespace ArandaCa\Handler\AsaTicket;

use stdClass;
use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class CreateTicketRequestHandler implements ArandaCaRequestHandleInterface {

    protected static $tempItemId = -1;
    protected static $categoryId = 6776;
    protected static $consoleType = "specialist";
    protected static $itemType = 4;
    protected static $itemVersion = 0;
    protected static $projectId = 17;
    protected static $modelId = 13;
    protected static $serviceId = 238;
    protected static $authorId = 56196;
    protected static $stateId = 71;
    protected static $listAdditionalField = [];

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
        $data = $this->formatData();

        $res = $this->aranda->createItem($data);

        if ($res['code'] >= 400) {
            return (object) ['codError' => 'La consulta no pudo ser procesada con éxito!'];
        }

        return $this->formatResponse($res['body']);          
    }
    
    public function formatData()
    {
        $data = $this->args[0];

        return [
            "tempItemId" => self::$tempItemId,
            "categoryId" => self::$categoryId,
            "consoleType" => self::$consoleType,
            "description" => $data['description'],
            "itemType" => self::$itemType,
            "itemVersion" => self::$itemVersion,
            "modelId" => self::$modelId,
            "projectId" => self::$projectId,
            "serviceId" => self::$serviceId,
            "stateId" => self::$stateId,            
            "authorId" => self::$authorId,
            "listAdditionalField" => self::$listAdditionalField
        ];
    }
    
    public function formatResponse($data)
    { 
        $idTicket = (object) ['idTicket' => 122];

        return (object) [
            'codError'       => '',
            'serviceOrderId' => [$idTicket]
        ];              
    }

}