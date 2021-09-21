<?php

namespace StackTonic\Calendly\Model;

class WebHook {
    public $uuid;
    public $uri;
    public $callback_url;
    public $created_at;
    public $updated_at;
    public $retry_started_at;
    public $state;
    public $events;
    public $scope;
    public $organization;
    public $user;
    public $creator;

    public function __construct($raw) {
        $this->uri = $raw['uri'];
        $this->callback_url = $raw['callback_url'];
        $this->created_at = $raw['created_at'];
        $this->updated_at = $raw['updated_at'];
        $this->retry_started_at = $raw['retry_started_at'];
        $this->state = $raw['state'];
        $this->events = [];
        $this->events = $raw['events'];
        $this->scope = $raw['scope'];
        $this->organization = $raw['organization'];
        $this->user = $raw['user'];
        $this->creator = $raw['creator'];

        $arr =  explode('/',$this->uri);
        $this->uuid = $arr[count($arr)-1];
    }
}
