<?php

namespace ArandaCa\Contract;

use ArandaCa\Aranda\Client;
use ArandaCa\Facade\ArandaCaFacade;

interface ArandaCaRequestHandleInterface
{
    public function __construct(Client $client, ArandaCaFacade $library);

    public function handle();
}