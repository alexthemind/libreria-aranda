<?php

namespace ArandaCa\Handler\AsaTicket;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class DoSelectRequestHandler implements ArandaCaRequestHandleInterface {    

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

        $res = $this->aranda->getItem($data);

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
        $data = $this->args[0];
        $whereClasue = $data['whereClause'];
        $arr = explode('=', $whereClasue);

        return $arr[1]; // id
       
    }
    
    public function formatResponse($data)
    { 
        return $data['id'];                
    }

}