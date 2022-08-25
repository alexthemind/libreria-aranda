<?php

namespace ArandaCa\Handler\Rfc;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class checkStatusRequestHandler implements ArandaCaRequestHandleInterface {

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
        $modelId = config('arandaca.aranda.model.id');
        $itemType = config('arandaca.aranda.item_type');
        
        $res = $this->aranda->getStates($modelId, $itemType);

        if ($res['code'] >= 400) {
            return ['resultado' => false, 'code' => null];
        }

        return $this->formatResponse($res['body']);          
    }   
    
    public function formatResponse($data)
    {  
        $stateToCheck = $this->args[1];

        foreach ($data->content as $state) {
            if ($state->name === $stateToCheck) {
                return [
                    'resultado' => true,
                    'code'      => $state->id
                ];
            }
        }

        return ['resultado' => false, 'code' => null];            
    }

}