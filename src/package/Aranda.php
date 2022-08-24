<?php

namespace Aranda\Lib\Package;

use Aranda\Lib\Interfaces\IService;
use Aranda\Lib\ArandaRequest;

use Session;

class Aranda {

    public static function servicios($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/project/17/4/services/search?';
        
        $params = [
           'console' => 'Specialist',
           'clientId' => '',
           'companyId' => '',
           'ciId' => '',
           'application' => 'ASDK',
           'criteria' => 'a',
        ];

        $result = ArandaRequest::get($url,$params,true);

        return $result;
    }

    public static function itemRelation($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/item/'.$params->id.'/relation';

        $result = ArandaRequest::post($url,$params,true);

        return $result;

    }

    public static function itemRelationList($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/item/'.$params->id.'/type/'.$params->type.'/relations/list?repository=1';

        $result = ArandaRequest::post($url,$params,true);

        return $result;

    }

    public static function caseCreate($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/item';

        $result = ArandaRequest::post($url,$params,true);

        return $result;

    }

    public static function caseUpdate($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/item/'.$params->id;

        $result = ArandaRequest::post($url,$params,true);

        return $result;

    }

    public static function getCase($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/item/'.array_shift($params);

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function listCase($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/item/search';

        $result = ArandaRequest::post($url,$params,true);

        return $result;

    }

    public static function addFile($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/file/';

        $result = ArandaRequest::post($url,$params,true,false);

        return $result;

    }

    public static function deleteFile($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/file/'.$params->id.'?uploadType=0';

        $result = ArandaRequest::delete($url,$params,true,false);

        return $result;

    }

    public static function downloadFile($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/file/'.array_shift($params);

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function listFile($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/item/'.array_shift($params).'/files?itemType=4&uploadType=0';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function addNote($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/item/'.$params->id.'/note';

        $result = ArandaRequest::post($url,$params,true);

        return $result;

    }

    public static function listHistory($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/item/'.$params->id.'/history/list?';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function addTask($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/task';

        $result = ArandaRequest::post($url,$params,true);

        return $result;

    }

    public static function listTask($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/item/'.$params->id.'/type/3/relations/list?repository=3';

        $result = ArandaRequest::post($url,$params,true);

        return $result;

    }

    public static function modelByCategory($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/item/4/categories/'.array_shift($params).'/model';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function states($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/model/16/4/states?';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function listServices($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/project/25/4/services/search?';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function userDetail($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/user?';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function userByProject($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/user/searchAll?';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function userEdit($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/user/'.$params->id;

        $result = ArandaRequest::put($url,$params,true);

        return $result;

    }

    public static function userCreate($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/user/';

        $result = ArandaRequest::post($url,$params,true);

        return $result;

    }

    public static function rootCategories($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/item/4/services/136/categories?';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function nodeCategories($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/item/4/services/136/categories?';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function getAditionalField($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/additionalsfields/4723/type/3/values?';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function listAditionalField($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/item/additionalfields';

        $result = ArandaRequest::post($url,$params,true);

        return $result;

    }

    public static function taskCreate($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/task/';

        $result = ArandaRequest::post($url,$params,true);

        return $result;

    }

    public static function getTask($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/task/'.array_shift($params);

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function taskUpdate($params=[]) {

        $url = env('HOST_ARANDA').'api/v9/task/'.$params->id;

        $result = ArandaRequest::put($url,$params,true);

        return $result;

    }

    public static function caseRelations($params=[]) {
        
        $url = env('HOST_ARANDA').'api/v9/item/'.array_shift($params).'/type/3/relations/list?repository=3';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function cisAdd($params=[]) {
        
        $url = env('HOST_ARANDA').'api/v9/ci';

        $result = ArandaRequest::post($url,$params,true);

        return $result;

    }

    public static function getDetails($params=[]) {
        
        $url = env('HOST_ARANDA').'api/v9/ci/?';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function getCisList($params=[]) {
        
        $url = env('HOST_ARANDA').'api/v9/ci/list';

        $result = ArandaRequest::post($url,$params,true);

        return $result;

    }

    public static function cisUpdate($params=[]) {
        
        $url = env('HOST_ARANDA').'api/v9/ci/'.array_shift($params);

        $result = ArandaRequest::put($url,$params,true);

        return $result;

    }

    public static function GetStatesByCategory($params=[]) {
        
        $url = env('HOST_ARANDA').'api/v9/ci/category/47/states?';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function searchCis($params=[]) {
        
        $url = env('HOST_ARANDA').'api/v9/ci/list';

        $result = ArandaRequest::post($url,$params,true);

        return $result;

    }

    public static function listAditionalFields($params=[]) {
        
        $url = env('HOST_ARANDA').'api/v9/ci/category/47/additionalfields';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function getCatalog($params=[]) {
        
        $url = env('HOST_ARANDA').'api/v9/catalog/BRAND?language=0';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function getProviders($params=[]) {
        
        $url = env('HOST_ARANDA').'api/v9/project/1/providers?criteria=a';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function listCategories($params=[]) {
        
        $url = env('HOST_ARANDA').'api/v9/ci/categories';

        $result = ArandaRequest::get($url,$params,true);

        return $result;

    }

    public static function deleteCI($params=[]) {
        
        $url = env('HOST_ARANDA').'api/v9/ci/'.array_shift($params);

        $result = ArandaRequest::delete($url,$params,true);

        return $result;

    }

    

}