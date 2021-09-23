<?php
namespace StackTonic\Calendly\Model\ScheduledEvent;

use StackTonic\Calendly\Model\ScheduledEvent\Location\InPersonMeeting;
use StackTonic\Calendly\Model\ScheduledEvent\Location\OutboundCall;

class Location
{
    public $type;

    public static function find($raw){
        switch ($raw['type']){
            case 'outbound_call':
                return new OutboundCall($raw);
            case 'physical':
                return new InPersonMeeting($raw);
        }

    }
}
