<?php

namespace Aranda\Lib;

use Session;

class ArandaRequest {

    public static function get($url,$params=[],$auth=false) {

        $url = $url.http_build_query($params);
       
        $headers = [
            "Content-Type: application/json",
        ];
        
        if($auth != false)
        {
            array_push($headers,"X-Authorization: Bearer ".Session::get('session_token'));
        }

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($curl);
        
        curl_close($curl);

        return $response;
    }

    public static function post($url,$params=[],$auth=false,$isJson=true) {
        
        if($isJson != false)
        {
            $datos_post = json_encode($params);
        }
        else
        {
            $datos_post = $params;
        }
        
        $headers = [
            "Content-Type: application/json",
        ];
        
        if($auth != false)
        {
            array_push($headers,"X-Authorization: Bearer ".Session::get('session_token'));
        }
        
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $datos_post);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($curl);

        curl_close($curl);
        
        return $response;

    }

    public static function delete($url,$params=[],$auth=false,$isJson=true) {
        
        if($isJson != false)
        {
            $datos_post = json_encode($params);
        }
        else
        {
            $datos_post = $params;
        }
        
        $headers = [
            "Content-Type: application/json",
        ];
        
        if($auth != false)
        {
            array_push($headers,"X-Authorization: Bearer ".Session::get('session_token'));
        }
        
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($curl);

        curl_close($curl);
        
        return $response;

    }

    public static function put($url,$params=[],$auth=false,$isJson=true) {
        
        if($isJson != false)
        {
            $datos_post = json_encode($params);
        }
        else
        {
            $datos_post = $params;
        }
        
        $headers = [
            "Content-Type: application/json",
        ];
        
        if($auth != false)
        {
            array_push($headers,"X-Authorization: Bearer ".Session::get('session_token'));
        }
        
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $datos_post);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($curl);

        curl_close($curl);
        
        return $response;

    }

}