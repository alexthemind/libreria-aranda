<?php

namespace ArandaCa\Factory\AsaTicket;

use ArandaCa\Factory\ArandaCaFactory;
use ArandaCa\Handler\LoginRequestHandler;
use ArandaCa\Handler\LogoutRequestHandler;
use ArandaCa\Handler\AsaTicket\DoSelectRequestHandler;

class ServiceDeskFullFactory extends ArandaCaFactory
{
    protected $methods = [
        'login' => LoginRequestHandler::class,
        'logout' => LogoutRequestHandler::class,
        'doSelect' => DoSelectRequestHandler::class
    ];
}
