<?php

namespace Aranda\Lib\Package\Sessions;

use Session;

use Aranda\Lib\ArandaRequest;

class SessionManager {

    private static $limit = 10;

    public static function Login() {

        try
        {
            $result;
    
            if(empty(Session::get('session')))
            {
                $url =  env('HOST_ARANDA').'/api/v9/authentication/';
        
                $params = [
                    "consoleType" => 1,
                    "password" => env('API_PASS'),     
                    "providerId" => 0,
                    "userName" => env('API_USER')
                ];

                $result = ArandaRequest::post($url,$params);

                $result = json_decode($result);
    
                /** LLENO LA SESSION */
                Session::set('session',$result);
                Session::set('session_token',$result->token);
                Session::set('session_life',date('Y-m-d H:m:i'));
            }
            else
            {
                self::SessionLifeCycle();
                $result = Session::get('session');
            }
    
            return $result;
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }

    }

    public static function renewSession() {

        try 
        {
            $url =  env('HOST_ARANDA').'/api/v9/authentication/renewtoken';

            $params = [
                'mode' => 'raw',
                'raw' => Session::get('session_token')
            ];

            $result = ArandaRequest::post($url,$params,true);

            $result = json_decode($result);

            /** LLENO LA SESSION */
            Session::set('session')->token = $result->token;
            Session::set('session_token',$result->token);
            Session::set('session_life',date('Y-m-d H:m:i'));

        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }

    }

    public static function LogOut() {

        try
        {
            $url =  env('HOST_ARANDA').'/api/v9/authentication/logout';

            $result = ArandaRequest::post($url,[],true);

            $result = json_decode($result);

            if($result->result)
            {
                Session::forget('session');
                Session::forget('session_token');
                Session::forget('session_life');

                return true;
            }

        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }

    }

    public static function SessionLifeCycle() {

        $from_time = date_create(Session::get('session_life'));
        $to_time = date_create(date('Y-m-d H:m:i'));

        $diff = date_diff($to_time,$from_time);

        if($diff->s >= self::$limit)
        {
            $logout = self::LogOut();

            if($logout)
            {
                self::Login();
            }
        }

    }

}