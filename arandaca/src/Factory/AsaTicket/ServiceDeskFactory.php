<?php

namespace ArandaCa\Factory\AsaTicket;

use ArandaCa\Factory\ArandaCaFactory;
use ArandaCa\Handler\AsaTicket\CreateTicketRequestHandler;

class ServiceDeskFactory extends ArandaCaFactory
{
    protected $methods = [
        "createTicket" => CreateTicketRequestHandler::class
    ];
}
