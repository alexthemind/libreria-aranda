<?php

namespace Aranda\Lib\Package;

use Aranda\Lib\Soap\SoapCalling;
use Aranda\Lib\WebUrl\WebServiceUrl as URL;

class PanelPriorizacion {

    private static function getUrl() {

        return URL::ServiceDesk_Url;
    
    }

    public static function GetDataTicketByOrganization($params=[]) {

        return SoapCalling::invokeSoapClient(self::getUrl(),__FUNCTION__,$params);

    }

    public static function getDataChild($params=[]) {

        return SoapCalling::invokeSoapClient(self::getUrl(),__FUNCTION__,$params);

    }

    public static function GetDataTenant($params=[]) {

        return SoapCalling::invokeSoapClient(self::getUrl(),__FUNCTION__,$params);

    }

    public static function GetListGroup($params=[]) {

        return SoapCalling::invokeSoapClient(self::getUrl(),__FUNCTION__,$params);

    }

}