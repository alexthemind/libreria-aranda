<?php

namespace ArandaCa\Factory\Panel;

use ArandaCa\Factory\ArandaCaFactory;
use ArandaCa\Handler\Panel\getGroupRequestHandler;
use ArandaCa\Handler\Panel\getTenantRequestHandler;
use ArandaCa\Handler\Panel\getDataChildRequestHandler;
use ArandaCa\Handler\Panel\getDataTicketRequestHandler;

class ServiceDeskFactory extends ArandaCaFactory
{
    protected $methods = [
        'getGroup'      => getGroupRequestHandler::class,
        'getDataChild'  => getDataChildRequestHandler::class,
        'getDataTicket' => getDataTicketRequestHandler::class,
        'getTenant'     => getTenantRequestHandler::class
    ];
}