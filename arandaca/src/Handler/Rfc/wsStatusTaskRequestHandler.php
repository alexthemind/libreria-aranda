<?php

namespace ArandaCa\Handler\Rfc;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class wsStatusTaskRequestHandler implements ArandaCaRequestHandleInterface {

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
        $id = $this->args[0]['numberTask'];

        $res = $this->aranda->getTask($id);

        if ($res['code'] >= 400) {
            return ['mensajeError' => 'La consulta no pudo ser procesada con éxito!'];
        }

        $data = $this->formatData($res['body']);

        $res = $this->aranda->updateTask($id, $data);

        if ($res['code'] >= 400) {
            return ['mensajeError' => 'La consulta no pudo ser procesada con éxito!'];
        }

        return true;
    }
    
    public function formatData($task)
    {
        $data = $this->args[0];     

        return [
            "consoleType" => "specialist",
            "description" => $data['description'],
            "groupId" => $task->groupId,
            "itemId" => $task->id,
            "itemType" => $task->itemType,
            "itemVersion" => $task->itemVersion,
            "modelId" => $task->modelId,
            "responsibleId" => $task->responsibleId,
            "stateId" => $task->stateId,
            "subject" => $task->subject
        ];
    }
    
    public function formatResponse($data)
    {  
        //           
    }

}