<?php
namespace StackTonic\Calendly\Model\EventType;

class Profile {
    public $type;
    public $name;
    public $owner;

    public function __construct($raw) {
        $this->type = $raw['type'];
        $this->name = $raw['name'];
        $this->owner = $raw['owner'];
    }
}


