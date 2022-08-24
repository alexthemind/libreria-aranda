<?php

namespace Aranda\Lib\Soap;

use Aranda\Lib\Config\Properties as PRO;
use SoapClient;
use ChannelAdvisorAuth;
use SoapHeader;
use SimpleXMLElement;

class SoapCalling {

    public static function invokeSoapClient($url,$method,$params) {

        $config = [
            'trace' => 1,
            'exception' => 0
        ];

        $soapClient = new SoapClient($url, $config);
        
        $auth = [
            'DeveloperKey' => PRO::KEY_AUTH,
            'Password' => PRO::PASS_AUTH,
        ];

        $header = new SoapHeader($url,'APICredentials',$auth,false);
        
        $params = [$method => $params];

        $result = $soapClient->__soapCall($method,$params,null,$header);

        return $result;

    }

}