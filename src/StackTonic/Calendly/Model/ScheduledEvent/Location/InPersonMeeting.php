<?php

namespace StackTonic\Calendly\Model\ScheduledEvent\Location;

class InPersonMeeting extends \StackTonic\Calendly\Model\ScheduledEvent\Location
{
    public $location;
    public function __construct($raw) {
        $this->type = $raw['type'];
        $this->location = $raw['location'];
    }
}
