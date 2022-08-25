<?php

namespace ArandaCa\Handler\Rfc;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;
use ArandaCa\Contract\ArandaCaRequestHandleInterface;

class updateTaskStatusGenericRequestHandler implements ArandaCaRequestHandleInterface {

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
        $id = $this->args[0]['idtask'];

        $res = $this->aranda->getTask($id);   
        
        if ($res['code'] >= 400) {
            return call_user_func_array(
                [$this->library->getWebService(), $this->library->getMethod()],
                $this->args
            );
        }

        $task = $res['body'];

        $data = $this->formatData($task);

        $res = $this->aranda->updateTask($id, $data);

        dd($res);

        if ($res['code'] >= 400) {
            return (object) ['mensajeError' => 'La consulta no pudo ser procesada con éxito!'];
        }

        return $this->formatResponse($task);
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
            "subject" => $task->subject,
            "listAdditionalField" => []
        ];
    }
    
    public function formatResponse($task)
    {  
        $idTicket = (object) ['idTask' => $task->id];

        return (object) [
            'mensajeError'       => NULL,
            'codError'       => NULL,
            'resultado' => [$idTicket]
        ];         
    }
}