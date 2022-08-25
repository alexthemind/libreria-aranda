<?php

namespace ArandaCa\Handler;

use stdClass;
use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class LoginRequestHandler implements ArandaCaRequestHandleInterface {

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

        $res = $this->aranda->auth($data);

        return $this->formatResponse($res['body']);          
    }
    
    public function formatData()
    {
        return [
            'userName' => config('arandaca.aranda.username'),
            'password' => config('arandaca.aranda.password'),
            'consoleType' => 1,
            'providerId' => 0
        ];
    }
    
    public function formatResponse($data)
    {
        $obj = new stdClass;
        $obj->loginReturn = $data->token;
        
        return $obj;
    }

}