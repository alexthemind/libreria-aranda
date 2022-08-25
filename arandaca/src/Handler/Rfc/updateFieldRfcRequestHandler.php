<?php

namespace ArandaCa\Handler\Rfc;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class updateFieldRfcRequestHandler implements ArandaCaRequestHandleInterface {

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
        $id = $this->args[0]['chgnumref'];

        $res = $this->aranda->getItem($id);

        if ($res['code'] >= 400) {
            return call_user_func_array(
                [$this->library->getWebService(), $this->library->getMethod()],
                $this->args
            );

        }

        $item = $res['body'];

        $data = $this->formatData($item);

        $res = $this->aranda->updateItem($id, $data);

        if ($res['code'] >= 400) {
            return [];
        }

        return $this->formatResponse($item);
    }
    
    public function formatData($item)
    {
        $dateStr = $this->args[0]['schedstartdate']; // d/m/Y H:i
        $arr = explode(' ', $dateStr); // Separar fecha y hora
        $date = $arr[0];
        $dateArr = explode('/', $date);
        $formatDate = $dateArr[2] . '/' . $dateArr[1] . '/' . $dateArr[0];

        $scheduledDate = strtotime($formatDate . ' ' . $arr[1]);

        return [
            "consoleType" => "specialist",
            "categoryId" => $item->categoryId,
            "description" => $item->description,
            "itemType" => $item->itemType,
            "itemVersion" => $item->itemVersion,
            "responsibleId" => $item->responsibleId,
            "modelId" => $item->modelId,
            "projectId" => $item->projectId,
            "serviceId" => $item->serviceId,
            "stateId" => $item->stateId,  
            "scheduledDate" => $scheduledDate,          
            "listAdditionalField" => []
        ];
    }
    
    public function formatResponse($data)
    {  
        return $data->id;        
    }

}