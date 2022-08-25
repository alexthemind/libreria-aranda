<?php

namespace ArandaCa\Factory\AsaTicket;

use ArandaCa\Factory\ArandaCaFactory;
use ArandaCa\Handler\AsaTicket\GetServiceOrderInformationRequestHandler;

class MoebiusDeskFactory extends ArandaCaFactory
{
    protected $methods = [
        'GetServiceOrderInformation' => GetServiceOrderInformationRequestHandler::class
    ];
}
