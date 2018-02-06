<?php

namespace subdee\TransipDnsUpdater;

class Config
{
    public $user;
    public $domain;
    public $subdomain;

    public function __construct()
    {
        $this->user = getenv('TRANSIP_USER');
        $this->domain = getenv('TRANSIP_DOMAIN');
        $this->subdomain = getenv('TRANSIP_SUBDOMAIN');

        return $this;
    }
}
