<?php

namespace ArandaCa\Handler\Rfc\CMDBService;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class categoriesRequestHandler implements ArandaCaRequestHandleInterface {

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
        $serviceId = config('arandaca.aranda.service_id');
        $itemType = config('arandaca.aranda.item_type');          

        $res = $this->aranda->getItem($itemType, $serviceId);

        if ($res['code'] >= 400) {
            return [];
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
        
        foreach ($data->content as $item) {
            $result[] = [
                'code' => $item->id,
                'name' => $item->name,
                'tenant.location.country.name' => '',
            ];
        }

        return [
            'listHandle' => $result,
            'listLength' => NULL
        ];
    }

}