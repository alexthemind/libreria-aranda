<?php

namespace ArandaCa\Handler\Rfc;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class getListTaskByRfcRequestHandler implements ArandaCaRequestHandleInterface {

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
        $itemType = config('arandaca.aranda.item_type');

        $data = $this->formatData();

        $res = $this->aranda->getItemTasks($id, $itemType, $data);

        if ($res['code'] >= 400) {
            return call_user_func_array(
                [$this->library->getWebService(), $this->library->getMethod()],
                $this->args
            );
        }      

        return $this->formatResponse($res['body']);         
    }    

    public function formatData()
    {
        return [           
            "isClosed" => false,
            "isReverse" => null,
            "relatedItemType" => 6,
            "relationTypeId" => null            
        ]; 
    }

    public function formatResponse($data)
    {
        foreach ($data->content as $task) {
            if ($task->name == "TSKIMPL") {
                return $task->id;
            }
        }

        return NULL;
    }

}