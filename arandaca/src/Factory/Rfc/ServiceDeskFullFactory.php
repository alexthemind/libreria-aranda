<?php

namespace ArandaCa\Factory\Rfc;

use ArandaCa\Factory\ArandaCaFactory;
use ArandaCa\Handler\LoginRequestHandler;
use ArandaCa\Handler\LogoutRequestHandler;
use ArandaCa\Handler\Rfc\ServiceDeskFull\doSelectRequestHandler;

class ServiceDeskFullFactory extends ArandaCaFactory
{
    protected $methods = [
        'login' => LoginRequestHandler::class,
        'logout' => LogoutRequestHandler::class,
        'doSelect' => doSelectRequestHandler::class
    ];
}
