<?php

namespace ArandaCa\Handler\Rfc;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class closeTicketRequestHandler implements ArandaCaRequestHandleInterface {

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
        $id = $this->args[0];

        $res = $this->aranda->getItem($id);

        if ($res['code'] >= 400) {
            return ['codError' => 'La consulta no pudo ser procesada con éxito!'];
        }

        $data = $this->formatData($res['body']);

        $this->aranda->updateItem($id, $data);

        return true;         
    }    

    public function formatData($item)
    {
        return [           
            "categoryId" => $item->categoryId,
            "itemType" => $item->itemType,
            "itemVersion" => $item->itemVersion,
            "modelId" => $item->modelId,
            "projectId" => $item->projectId,
            "serviceId" => $item->serviceId,
            "stateId" => config('arandaca.aranda.model.final_state_id'),            
            "responsibleId" => $item->responsibleId,
            "listAdditionalField" => $item->listAdditionalField            
        ]; 
    }

}