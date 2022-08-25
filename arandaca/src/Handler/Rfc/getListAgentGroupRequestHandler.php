<?php

namespace ArandaCa\Handler\Rfc;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class getListAgentGroupRequestHandler implements ArandaCaRequestHandleInterface {

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
        $groupId = $this->args[0]['idGroup'];    
        
        $res = $this->aranda->getUsersByGroup($groupId);

        if ($res['code'] >= 400) {
            return 0;
        }

        return $this->formatResponse($res['body']);
    }
    
    public function formatData()
    {
        //
    }
    
    public function formatResponse($data)
    {         
        $result = [];
        
        foreach ($data->content as $user) {
            $result[] = [
                "idMember" => $user->id,
                "name" => $user->name,
                "tenant" => $user->proyectId,
                "phonenumber" => NULL,
                "email" => NULL,
                "cargo" => NULL
            ];
        }

        return $result;
    }

}