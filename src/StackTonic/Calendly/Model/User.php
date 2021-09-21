<?php

namespace StackTonic\Calendly\Model;

class User {
    public $uri;
    public $name;
    public $slug;
    public $email;
    public $scheduling_url;
    public $timezone;
    public $avatar_url;
    public $created_at;
    public $updated_at;
    public $current_organization;

    public function __construct($raw) {
        $this->uri = $raw['uri'];
        $this->name = $raw['name'];
        $this->slug = $raw['slug'];
        $this->email = $raw['email'];
        $this->scheduling_url = $raw['scheduling_url'];
        $this->timezone = $raw['timezone'];
        $this->avatar_url = $raw['avatar_url'];
        $this->created_at = $raw['created_at'];
        $this->updated_at = $raw['updated_at'];
        $this->current_organization = $raw['current_organization'];
    }
}
