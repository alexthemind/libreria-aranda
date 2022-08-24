<?php

namespace Aranda\Lib;

class Actions {

    public static function callMethod($service,$method,$params=[]) {

        return call_user_func_array([$service,$method],[$params]);
        
    }

}



