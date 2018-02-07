<?php

namespace subdee\TransipDnsUpdater;

class IpGrabber
{
    const IP_URL = 'http://ipv4.icanhazip.com';

    public function getCurrentIp()
    {
        return trim(file_get_contents(self::IP_URL));
    }
}
