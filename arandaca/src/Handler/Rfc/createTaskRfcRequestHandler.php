<?php

namespace ArandaCa\Handler\Rfc;

use Carbon\Carbon;
use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class createTaskRfcRequestHandler implements ArandaCaRequestHandleInterface {

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

        $res = $this->aranda->createTask($data);

        if ($res['code'] >= 400) {
            return (object) ['mensajeError' => 'La consulta no pudo ser procesada con éxito!'];
        }

        return $this->formatResponse($res['body']);
    }
    
    public function formatData()
    {
        $data = $this->args[0];     

        return [
            "consoleType" => "specialist",
            "description" => $data['description'],
            "duration" => 300,
            "groupId" => $data['idGroup'],
            "parentId" => $data['numref'],
            "itemType" => config('arandaca.aranda.item_type'),
            "itemVersion" => 0,
            "modelId" => 649,
            "responsibleId" => $data['idAssignee'],
            "stateId" => 9379,
            "subject" => $data['summary'],
            "projectId" => config('arandaca.aranda.project_id'),
            "relationTypeId" => config('arandaca.aranda.item_type'),
            "startDate" => time(),
            "endDate" => Carbon::now()->addMinutes(75)->timestamp,
            "tempId" => -1
        ];      
    }
    
    public function formatResponse($data)
    {  
        $idTicket = (object) ['serviceorderid' => $data->id];

        return (object) [
            'mensajeError'       => NULL,
            'resultado' => [$idTicket]
        ];         
    }

}