<?php
namespace StackTonic\Calendly\Model\ScheduledEvent;

use StackTonic\Calendly\Model\ScheduledEvent\Location\InPersonMeeting;

class Location
{
    public $type;

    public static function find($raw){
        switch ($raw['type']){
            case 'physical':
                return new InPersonMeeting($raw);
        }

    }
}
