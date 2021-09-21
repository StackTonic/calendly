<?php

namespace StackTonic\Calendly;

class Client
{
    protected $token;

    public function __construct($token) {
        $this->token = $token;
    }
}