<?php

namespace StackTonic\Calendly\Rest\Api;

use StackTonic\Calendly\Model\User;
use StackTonic\Calendly\Rest\Api;
use StackTonic\Calendly\Rest\Client;

class Users extends Api {
    private $uri;
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->uri = '/users/';
    }
    public function me(){
        return $this->get('me');
    }
    public function get($uuid){
        return new User($this->fetch('GET',$this->uri.$uuid)['resource']);
    }
}
