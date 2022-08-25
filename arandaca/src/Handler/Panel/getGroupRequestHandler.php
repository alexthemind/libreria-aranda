<?php

namespace ArandaCa\Handler\Panel;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class getGroupRequestHandler implements ArandaCaRequestHandleInterface {

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
        $serviceId = config('arandaca.aranda.groups.service_id');
        $stateId = config('arandaca.aranda.groups.state_id');
        
        $res = $this->aranda->getGroups($serviceId, $stateId);
        
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
        
        foreach ($data->content as $group) {
            $result[] = (object) [
                "idGrupo" => $group->id
            ];
        }

        return $result;
    }

}