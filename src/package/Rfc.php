<?php

namespace Aranda\Lib\Package;

use Aranda\Lib\Soap\SoapCalling;
use Aranda\Lib\WebUrl\WebServiceUrl as URL;

use SimpleXMLElement;

class RFC {

    private static function getUrl() {

        return URL::Rfc_Omologation_Url;
    
    }

    public static function Login($params=[]) {

        return SoapCalling::invokeSoapClient(self::getUrl(),__FUNCTION__,$params);

    }

    public static function Logout($params=[]) {

        return SoapCalling::invokeSoapClient(self::getUrl(),__FUNCTION__,$params);

    }

    public static function doSelect($params=[]) {

        $result = SoapCalling::invokeSoapClient(self::getUrl(),__FUNCTION__,$params);
        return self::parseXML(array_values((array)$result)[0]);

    }

    public static function doQuery($params=[]) {

        $result = SoapCalling::invokeSoapClient(self::getUrl(),__FUNCTION__,$params);
        return $result;

    }

    public static function getListValues($params=[]) {

        $result = SoapCalling::invokeSoapClient(self::getUrl(),__FUNCTION__,$params);
        return $result;

    }

    public static function updateObject($params=[]) {

        $result = SoapCalling::invokeSoapClient(self::getUrl(),__FUNCTION__,$params);
        return $result;

    }

    public static function AddCIByChangeOrderGeneric($params=[]) {

        $result = SoapCalling::invokeSoapClient(self::getUrl(),__FUNCTION__,$params);
        return $result;

    }

    public static function CreateRfcGeneric($params=[]) {

        $result = SoapCalling::invokeSoapClient(self::getUrl(),__FUNCTION__,$params);
        return $result;

    }

    public static function DeleteCIChangeOrder($params=[]) {

        $result = SoapCalling::invokeSoapClient(self::getUrl(),__FUNCTION__,$params);
        return $result;

    }

    public static function GetListAgentGroup($params=[]) {

        $result = SoapCalling::invokeSoapClient(URL::ServiceDesk_Url,__FUNCTION__,$params);
        return $result;

    }

    public static function GetListClosureCode($params=[]) {

        $result = SoapCalling::invokeSoapClient(URL::ServiceDesk_Url,__FUNCTION__,$params);
        return $result;

    }

    public static function GetListGroup($params=[]) {

        $result = SoapCalling::invokeSoapClient(URL::ServiceDesk_Url,__FUNCTION__,$params);
        return $result;

    }

    public static function GetListStatusByIdTaskType($params=[]) {

        $result = SoapCalling::invokeSoapClient(URL::ServiceDesk_Url,__FUNCTION__,$params);
        return $result;

    }

    public static function parseXML($xml) {

        return new SimpleXMLElement($xml);

    }

}