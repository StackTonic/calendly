<?php

namespace StackTonic\Calendly\Rest\Api;

use StackTonic\Calendly\Model\EventType;
use StackTonic\Calendly\Model\User;
use StackTonic\Calendly\Model\WebHook;
use StackTonic\Calendly\Rest\Api;
use StackTonic\Calendly\Rest\Client;

class Webhooks extends Api {
    private $uri;
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->uri = '/webhook_subscriptions';
    }
    public function create($url, $events, $organization,$scope,$signing_key,$user=null){
        var_dump($events);
        $response = $this->request(
            'post',
            $this->uri,
            [],
            [
                'url'=>$url,
                'events'=>$events,
                'organization'=>$organization,
                'scope'=>$scope,
                'signing_key'=>$signing_key
            ],
            [],
            null,
            null,
            null
        );
        var_dump($response->getContent());
        return new WebHook($response->getContent());

    }
    public function query($type, $uuid,$count=20,$page_token=null){
        $params=[];
        switch ($type) {
            case 'organization':
                $params=['scope'=>'organization','organization'=>$uuid];
                break;
            case 'user':
                $params=['scope'=>'user','user'=>$uuid];
                break;
            default:
                throw new CalendlyException('No Query Type Defined');
        }
        $params[]=['count'=>$count,'page_token'=>$page_token];
        $result = $this->fetch('GET',$this->uri,$params);
        $response =[];
        foreach ($result['collection'] as $event){
            $response[]=new WebHook($event);
        }
        return $response;
    }


    public function get($uuid){
        return new WebHook($this->fetch('GET',$this->uri.'/'.$uuid)['resource']);
    }
    public function delete($uuid){
        $response = $this->request(
            'DELETE',
            $this->uri.'/'.$uuid,
            [],
            [],
            ['Content-Type'=>'application/json'],
            null,
            null,
            null
        );

        // 3XX response codes are allowed here to allow for 307 redirect from Deactivations API.
        if ($response->getStatusCode() !=204) {
            throw $this->exception($response, 'Unable to delete record');
        }

        return $response->getContent();
    }
}
