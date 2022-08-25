<?php

namespace ArandaCa\Handler;

use stdClass;
use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class getRfcRequestHandler implements ArandaCaRequestHandleInterface {

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
            return (object) ['codError' => 'La consulta no pudo ser procesada con éxito!'];
        }

        return $this->formatResponse($res['body']);          
    }
    
    public function formatData()
    {
        return $this->args[0]; //id
    }
    
    public function formatResponse($data)
    {  
        $opening = NULL;
        
        if (!is_null($data->initialDate)) {
            $opening = date('d/m/Y H:i', $data->initialDate);
        }

        return [
            'codError'      => '',
            'number'        => $data->id,
            'type'          => $data->itemTypeName,
            'solutiongroup' => $data->groupName,
            'agentName'     => $data->authorName,
            'opening'       => $opening,
            'status'        => $data->stateName,
            'observations'  => $data->descriptionNoHtml,
            'priority'      => $data->priorityName,
            'subsidiary'    => NULL
        ];              
    }

}