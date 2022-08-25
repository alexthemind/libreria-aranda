<?php

namespace ArandaCa\Handler\Rfc;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class createRfcRequestHandler implements ArandaCaRequestHandleInterface {

    protected static $tempItemId = -1;
    protected static $categoryId = 6776;
    protected static $consoleType = "specialist";
    protected static $itemVersion = 0;
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
            "subject" => $data['summary'],
            "itemType" => config('arandaca.aranda.item_type'),
            "itemVersion" => self::$itemVersion,
            "modelId" => config('arandaca.aranda.model.id'),
            "projectId" => config('arandaca.aranda.project_id'),
            "serviceId" => config('arandaca.aranda.service_id'),
            "stateId" => config('arandaca.aranda.model.initial_state_id'),            
            "authorId" => $data['idTenant'],
            "listAdditionalField" => self::$listAdditionalField
        ];
    }
    
    public function formatResponse($data)
    { 
        $idTicket = (object) ['idRfc' => $data->id];

        return (object) [
            'codError'       => '',
            'serviceOrderId' => [$idTicket]
        ];              
    }

}