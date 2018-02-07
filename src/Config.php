<?php

namespace subdee\TransipDnsUpdater;

class Config
{
    public $user;
    public $domain;
    public $subdomain;

    public function __construct(Environment $environment)
    {
        $this->user = $environment->getValue('TRANSIP_USER');
        $this->domain = $environment->getValue('TRANSIP_DOMAIN');
        $this->subdomain = $environment->getValue('TRANSIP_SUBDOMAIN');

        return $this;
    }
}
