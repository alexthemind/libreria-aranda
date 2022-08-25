<?php

namespace ArandaCa\Handler\Panel;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class getDataChildRequestHandler implements ArandaCaRequestHandleInterface {

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
        return $this->args[0]['refnum']; //id
    }
    
    public function formatResponse($data)
    {  
        $opening = NULL;
        
        if (!is_null($data->initialDate)) {
            $opening = date('d/m/Y H:i', $data->initialDate);
        }

        return [
            "padre" => [
                [
                    "FechaApertura" => $opening,
                    "descripcion"   => $data->descriptionNoHtml,
                ]
            ]
        ];                     
    }

}