<?php

namespace StackTonic\Calendly\Model;

use StackTonic\Calendly\Model\EventType\CustomQuestions;
use StackTonic\Calendly\Model\EventType\Profile;

class EventType {
    public $uri;
    public $name;
    public $active;
    public $slug;
    public $scheduling_url;
    public $duration;
    public $kind;
    public $pooling_type;
    public $type;
    public $color;
    public $created_at;
    public $updated_at;
    public $internal_note;
    public $description_plain;
    public $description_html;
    public $profile;
    public $secret;
    public $custom_questions;
    public $current_organization;
    public $uuid;

    public function __construct($raw) {
        $this->uri = $raw['uri'];
        $this->name = $raw['name'];
        $this->active = $raw['active'];
        $this->slug = $raw['slug'];
        $this->scheduling_url = $raw['scheduling_url'];
        $this->duration = $raw['duration'];
        $this->kind = $raw['kind'];
        $this->pooling_type = $raw['pooling_type'];
        $this->type = $raw['type'];
        $this->color = $raw['color'];
        $this->created_at = $raw['created_at'];
        $this->updated_at = $raw['updated_at'];
        $this->internal_note = $raw['internal_note'];
        $this->description_plain = $raw['description_plain'];
        $this->description_html = $raw['description_html'];
        $this->profile = new Profile($raw['profile']);
        $this->secret = $raw['secret'];
        $this->custom_questions = [];
        foreach ($raw['custom_questions'] as $cq) {
            $this->custom_questions[] = new CustomQuestions($cq);
        }
        $arr =  explode('/',$this->uri);
        $this->uuid = $arr[count($arr)-1];
    }
}
