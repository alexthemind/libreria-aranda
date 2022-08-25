<?php

namespace ArandaCa\Factory\Rfc;

use ArandaCa\Factory\ArandaCaFactory;
use ArandaCa\Handler\Rfc\CMDBService\doQueryRequestHandler;
use ArandaCa\Handler\Rfc\CMDBService\doSelectRequestHandler;
use ArandaCa\Handler\Rfc\CMDBService\getListValuesRequestHandler;

class CMDBServiceFactory extends ArandaCaFactory
{
    protected $methods = [
        'doSelect'      => doSelectRequestHandler::class,
        'doQuery'       => doQueryRequestHandler::class,
        'getListValues' => getListValuesRequestHandler::class
    ];
}
