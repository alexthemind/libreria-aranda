<?php

namespace ArandaCa\Handler\AsaTicket;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class UpdateObjectRequestHandler implements ArandaCaRequestHandleInterface {        

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
        $id = $this->args[0]['objectHandle']; 

        $res = $this->aranda->getItem($id);

        if ($res['code'] >= 400) {
            return call_user_func_array(
                [$this->library->getWebService(), $this->library->getMethod()],
                $this->args
            );
        }

        $data = $this->formatData($res['body']);

        $res = $this->aranda->updateItem($id, $data);

        if ($res['code'] >= 400) {
            return (object) ['codError' => 'La consulta no pudo ser procesada con éxito!'];
        }

        return $id;          
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
            "stateId" => $item->stateId,            
            "responsibleId" => $item->responsibleId,
            "listAdditionalField" => $item->listAdditionalField            
        ];   
    }   

}