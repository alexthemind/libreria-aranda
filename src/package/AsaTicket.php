<?php

namespace Aranda\Lib\Package;

use Aranda\Lib\Interfaces\IService;
use Aranda\Lib\ArandaRequest;

class AsaTicket {

    public static function getRfc($params=[]) {

        $url = 'http://localhost:8081/api/os/'.implode('/',$params);

        $result = ArandaRequest::get($url);

        return $result;

    }

}