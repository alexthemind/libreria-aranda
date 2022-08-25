<?php

namespace ArandaCa\Handler\Rfc;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class addCIByChangeOrderGenericRequestHandler implements ArandaCaRequestHandleInterface {

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
        
        $res = $this->aranda->addRelation($data["id"], $data); 

        if ($res['code'] >= 400) {
            return ['codError' => 'La consulta no pudo ser procesada con éxito!'];
        }

        return $this->formatResponse($res['body']);        
    }
    
    public function formatData()
    {
        $field = $this->args[0]['idci'][0];
        $arr   = explode(':', $field);
        $ciId  = $arr[1];

        $id = $this->args[0]['rfcnum'];

        return [
            "id"=> $id,
            "isSolution"=> false,
            "itemType"=> config('arandaca.aranda.item_type'),
            "itemType"=> 4,
            "relatedItemId"=> $ciId,
            "relatedItemType"=> "CI",
            "relationTypeId"=> 1,
            "typeIsReverse"=> true
        ];
    }
    
    public function formatResponse($data)
    {  
        return [
            "codError" => "0",
            "mensajeError" => ""
        ];          
    }

}