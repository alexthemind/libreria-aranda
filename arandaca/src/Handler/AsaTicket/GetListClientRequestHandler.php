<?php

namespace ArandaCa\Handler\AsaTicket;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class GetListClientRequestHandler implements ArandaCaRequestHandleInterface {    
    
    protected $userId = 1;

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
        return (object) [
            'codError' => 'La consulta no pudo ser procesada con éxito!',
            'resultado'=> '',
        ];

        // $data = $this->formatData();

        // $res = $this->aranda->searchUsers($data, self::$userId);

        // if ($res['code'] >= 400) {
        //     return (object) [
        //         'codError' => 'La consulta no pudo ser procesada con éxito!',
        //         'resultado'=> '',
        //     ];
        // }

        // return $this->formatResponse($res['body']);          
    }

    public function formatData()
    {
        
    }

    public function formatResponse($data)
    {
        return $data;
    }
}    