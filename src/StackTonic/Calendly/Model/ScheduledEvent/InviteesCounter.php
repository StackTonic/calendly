<?php
namespace StackTonic\Calendly\Model\ScheduledEvent;

class InviteesCounter
{
    public $total;
    public $active;
    public $limit;
    public function __construct($raw) {
        $this->total = $raw['total'];
        $this->active = $raw['active'];
        $this->limit = $raw['limit'];
    }
}
