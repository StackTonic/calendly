<?php

namespace StackTonic\Calendly\Model\EventType;

class CustomQuestions
{
    public $name;
    public $type;
    public $position;
    public $enabled;
    public $required;
    public $answer_choices;
    public $include_other;

    public function __construct($raw)
    {
        $this->name = $raw['name'];
        $this->type = $raw['type'];
        $this->name = $raw['name'];
        $this->position = $raw['position'];
        $this->enabled = $raw['enabled'];
        $this->required = $raw['required'];
        $this->answer_choices = [];
        $this->answer_choices = $raw['answer_choices'];
        $this->include_other = $raw['include_other'];
    }

}
