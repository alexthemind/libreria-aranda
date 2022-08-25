<?php

namespace ArandaCa\Handler\Rfc\ServiceDeskFull;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class crDoSelectRequestHandler implements ArandaCaRequestHandleInterface {

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
        $where = $this->args[0]['whereClause'];
        $arr = explode("=", $where);
        $id = $arr[1];

        $res = $this->aranda->getItem($id);

        if ($res['code'] >= 400) {
            return ['codError' => 'La consulta no pudo ser procesada con éxito!'];
        }

        return $this->formatResponse($res['body']);
    }
    
    public function formatData()
    {
        //
    }
    
    public function formatResponse($data)
    {  
        return $data->id;          
    }

}