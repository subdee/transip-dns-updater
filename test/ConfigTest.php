<?php

use PHPUnit\Framework\TestCase;
use subdee\TransipDnsUpdater\Config;
use subdee\TransipDnsUpdater\Environment;

class ConfigTest extends TestCase
{

    public function testInitialization()
    {
        $mockEnvironment = $this->createMock(Environment::class);
        $mockEnvironment->method('getValue')->willReturn('test');

        $config = new Config($mockEnvironment);

        $this->assertEquals('test', $config->user);
    }
}
