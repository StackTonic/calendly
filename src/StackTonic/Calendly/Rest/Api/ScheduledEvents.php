<?php

namespace StackTonic\Calendly\Rest\Api;

use StackTonic\Calendly\Model\ScheduledEvent;
use StackTonic\Calendly\Model\User;
use StackTonic\Calendly\Rest\Api;
use StackTonic\Calendly\Rest\Client;

class ScheduledEvents extends Api {
    private $uri;
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->uri = '/scheduled_events';
    }
    public function query(
        $user=null,
        $organization=null,
        $count=20,
        $page_token=null,
        $status='active',
        $min_start_time=null,
        $max_start_time=null
    ){
        $params=[];
        if ($user!=null) {
            $params=['user'=>$user];
        }
        if ($organization!=null) {
            $params=['organization'=>$organization];
        }
        $params[]=['count'=>$count,'page_token'=>$page_token,'status'=>$status,
            'min_start_time'=>$min_start_time,'max_start_time'=>$max_start_time];
        $result = $this->fetch('GET',$this->uri,$params);
        $response =[];
        foreach ($result['collection'] as $event){
            $response[]=new ScheduledEvent($event);
        }
        return $response;
    }
    public function get($uuid){
        return new ScheduledEvent($this->fetch('GET',$this->uri.'/'.$uuid)['resource']);
    }
}
