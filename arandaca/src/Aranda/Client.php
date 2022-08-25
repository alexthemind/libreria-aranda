<?php

namespace ArandaCa\Aranda;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\ClientInterface;

class Client {

    protected $uri;

    protected $token = NULL;

    private $httpClient;

    private $options = [];

    protected $headers = [
        'Content-Type'     => 'application/json'
    ];

    public function __construct($uri, ClientInterface $httpClient)
    {
        $this->uri = $uri;

        $this->httpClient = $httpClient;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
        $this->headers['X-Authorization'] = 'Bearer ' . $this->token;
    }

    public function auth(array $data)
    {        
        $request = new Request('POST', $this->uri . '/authentication/', $this->headers, json_encode($data));
        $res = $this->makeRequest($request);
        if ($res['code'] >= 400) {
            return $res;
        }

        $this->token = $res['body']->token;
        $this->headers['X-Authorization'] = 'Bearer ' . $this->token;

        return $res;
    }

    public function logout()
    {
        $request = new Request('POST', $this->uri . '/authentication/logout/', $this->headers);
        $res = $this->makeRequest($request);
        if ($res['code'] >= 400) {
            return $res;
        }

        $this->token = NULL;
        unset($this->headers['X-Authorization']);

        return $res;
    }

    public function createItem(array $data)
    {
        $request = new Request('POST', $this->uri . '/item/', $this->headers, json_encode($data));

        return $this->makeRequest($request);
    }

    public function getItem($id)
    {       
        $request = new Request('GET', $this->uri . '/item/' . $id, $this->headers);
        return $this->makeRequest($request);
    }

    public function updateItem($id, $data)
    {
        $request = new Request('PUT', $this->uri . '/item/' . $id, $this->headers, json_encode($data));
        return $this->makeRequest($request);
    }

    public function searchUsers($data, $id)
    {
        $query = http_build_query($data);
        $request = new Request('GET', $this->uri . '/user/' . $id . '/search?' . $query, $this->headers);
       
        return $this->makeRequest($request);
    }

    public function getStates($modelId, $itemType, $stateId = NULL)
    {  
        $url = $this->uri . "/model/$modelId/$itemType/states?" . http_build_query(['stateId' => $stateId]);

        $request = new Request('GET', $url, $this->headers);
        return $this->makeRequest($request);
    }

    public function getItemTasks($itemId, $itemType, $data)
    {
        $url = $this->uri . "/item/$itemId/type/$itemType/relations/list";

        $request = new Request('POST', $url, $this->headers, json_encode($data));
        return $this->makeRequest($request);
    }

    public function getTask($id)
    {
        $url = $this->uri . "/task/$id";

        $request = new Request('GET', $url, $this->headers);
        return $this->makeRequest($request);
    }

    public function createTask($data)
    {
        $url = $this->uri . "/task/";

        $request = new Request('POST', $url, $this->headers, json_encode($data));
        return $this->makeRequest($request);
    }

    public function updateTask($id, $data)
    {
        $url = $this->uri . "/task/$id";

        $request = new Request('PUT', $url, $this->headers, json_encode($data));
        return $this->makeRequest($request);
    }

    public function getCategories($itemType, $serviceId)
    {
        $url = $this->uri . "/item/$itemType/services/$serviceId/categories";

        $request = new Request('GET', $url, $this->headers);
        return $this->makeRequest($request);
    }

    public function addRelation($id, $data)
    {
        $url = $this->uri . "/item/$id/relation";

        $request = new Request('POST', $url, $this->headers, json_encode($data));
        return $this->makeRequest($request);
    }

    public function getGroups($serviceId, $stateId)
    {
        $url = $this->uri . "/service/$serviceId/state/$stateId/group/list";

        $request = new Request('GET', $url, $this->headers);
        return $this->makeRequest($request);
    }

    public function getUsersByGroup($groupId)
    {
        $url = $this->uri . "/group/$groupId/specialists";

        $request = new Request('GET', $url, $this->headers);
        return $this->makeRequest($request);
    }

    private function makeRequest(Request $request)
    {
        try {
            $res = $this->httpClient->sendAsync($request, ['http_errors' => false])->wait();
            $body = json_decode($res->getBody()->getContents());           
        }
        catch (GuzzleHttp\Exception\ServerException $e) {
            $res = $e->getResponse();      
            $body = $res->getBody();  
        }

        return [
            'code' => $res->getStatusCode(),
            'body' => $body
        ];       
    }

}