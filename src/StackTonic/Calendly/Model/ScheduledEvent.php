<?php

namespace StackTonic\Calendly\Model;

use StackTonic\Calendly\Model\ScheduledEvent\InviteesCounter;
use StackTonic\Calendly\Model\ScheduledEvent\Location;

class ScheduledEvent {
    public $uri;
    public $name;
    public $status;
    public $start_time;
    public $end_time;
    public $event_type;
    public $location;
    public $invitees_counter;
    public $created_at;
    public $updated_at;

    public function __construct($raw) {
        $this->uri = $raw['uri'];
        $this->name = $raw['name'];
        $this->status = $raw['status'];
        $this->start_time = $raw['start_time'];
        $this->end_time = $raw['end_time'];
        $this->event_type = $raw['event_type'];
        $this->location = Location::Find($raw['location']);
        $this->invitees_counter = new InviteesCounter($raw['invitees_counter']);
        $this->created_at = $raw['created_at'];
        $this->updated_at = $raw['updated_at'];
        $this->event_memberships = [];
        $this->event_memberships = $raw['event_memberships'];
        $this->event_guests = [];
        $this->event_guests = $raw['event_guests'];

    }
}
