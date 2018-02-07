<?php

namespace subdee\TransipDnsUpdater;


class Environment
{
    public function getValue(string $key)
    {
        return getenv($key);
    }
}
