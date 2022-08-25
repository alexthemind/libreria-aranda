<?php

namespace ArandaCa\Factory\Rfc;

use ArandaCa\Factory\ArandaCaFactory;
use ArandaCa\Handler\createRfcRequestHandler;
use ArandaCa\Handler\Rfc\checkStatusRequestHandler;
use ArandaCa\Handler\Rfc\closeTicketRequestHandler;
use ArandaCa\Handler\Rfc\getListGroupRequestHandler;
use ArandaCa\Handler\Rfc\getPirStatusRequestHandler;
use ArandaCa\Handler\Rfc\wsStatusTaskRequestHandler;
use ArandaCa\Handler\Rfc\createTaskRfcRequestHandler;
use ArandaCa\Handler\Rfc\updateFieldRfcRequestHandler;
use ArandaCa\Handler\Rfc\getOriginChangeRequestHandler;
use ArandaCa\Handler\Rfc\getCodCloseByRFCRequestHandler;
use ArandaCa\Handler\Rfc\getListTaskByRfcRequestHandler;
use ArandaCa\Handler\Rfc\getListAgentGroupRequestHandler;
use ArandaCa\Handler\Rfc\deleteCIChangeOrderRequestHandler;
use ArandaCa\Handler\Rfc\getCompaniForTenantRequestHandler;
use ArandaCa\Handler\Rfc\updateTaskStatusGenericRequestHandler;
use ArandaCa\Handler\Rfc\addCIByChangeOrderGenericRequestHandler;
use ArandaCa\Handler\Rfc\getListTaskByRfcAndTaskIdRequestHandler;

class ServiceDeskFactory extends ArandaCaFactory
{
    protected $methods = [
        'getCodCloseByRFC' => getCodCloseByRFCRequestHandler::class,
        'checkStatus' => checkStatusRequestHandler::class,
        'closeTicket' => closeTicketRequestHandler::class,
        'getListTaskByRfc' => getListTaskByRfcRequestHandler::class,
        'getPirStatus' => getPirStatusRequestHandler::class,
        'GetListGroup' => getListGroupRequestHandler::class,
        'getCompaniForTenant' => getCompaniForTenantRequestHandler::class,
        'getOriginChange' => getOriginChangeRequestHandler::class,
        'getListAgentGroup' => getListAgentGroupRequestHandler::class,
        'wsStatusTask' => wsStatusTaskRequestHandler::class,
        'createTaskRfc' => createTaskRfcRequestHandler::class,
        'createRfc' => createRfcRequestHandler::class,
        'addCIByChangeOrderGeneric' => addCIByChangeOrderGenericRequestHandler::class,
        'deleteCIChangeOrder' => deleteCIChangeOrderRequestHandler::class,
        'UpdateFieldRfc' => updateFieldRfcRequestHandler::class,
        'getListTaskByRfcAndTaskId' => getListTaskByRfcAndTaskIdRequestHandler::class,
        'updateTaskStatusGeneric' => updateTaskStatusGenericRequestHandler::class
    ];
}
