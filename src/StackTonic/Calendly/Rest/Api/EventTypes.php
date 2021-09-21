<?php

namespace StackTonic\Calendly\Rest\Api;

use StackTonic\Calendly\Model\EventType;
use StackTonic\Calendly\Model\User;
use StackTonic\Calendly\Rest\Api;
use StackTonic\Calendly\Rest\Client;
use StackTonic\Calendly\Exceptions\CalendlyException;


class EventTypes extends Api {
    private $uri;
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->uri = '/event_types';
    }

    public function query($type, $uuid,$count=20,$page_token=null){
        $params=[];
        switch ($type) {
            case 'organization':
                $params=['organization'=>$uuid];
                break;
            case 'user':
                $params=['user'=>$uuid];
                break;
            default:
                throw new CalendlyException('No Query Type Defined');
        }
        $params[]=['count'=>$count,'page_token'=>$page_token];
        $result = $this->fetch('GET',$this->uri,$params);
        $response =[];
        foreach ($result['collection'] as $event){
            $response[]=new EventType($event);
        }
        return $response;
    }

    public function get($uuid){
        return new EventType($this->fetch('GET',$this->uri.'/'.$uuid)['resource']);
    }
}
