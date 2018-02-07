<?php

use PHPUnit\Framework\TestCase;
use subdee\TransipDnsUpdater\Config;
use subdee\TransipDnsUpdater\Environment;
use subdee\TransipDnsUpdater\IpGrabber;
use subdee\TransipDnsUpdater\Updater;
use TransIP\Api\Domain;
use TransIP\Client;
use TransIP\Model\DnsEntry;

class UpdaterTest extends TestCase
{
    private $mockClient;
    private $mockDomainApi;
    private $mockIpGrabber;

    public function testUpdateWithProperValues()
    {
        $this->createMocks('test');
        $config = new Config(new Environment());

        $updater = new Updater($this->mockClient, $config, $this->mockIpGrabber);
        $this->assertEquals(null, $updater->update());
    }

    public function testUpdateWithMissingSubdomain()
    {
        $this->createMocks('test2');
        $config = new Config(new Environment());

        $updater = new Updater($this->mockClient, $config, $this->mockIpGrabber);
        $this->assertEquals(null, $updater->update());
    }

    public function testUpdateThrowsException()
    {
        $this->createMocks('test3', true);
        $config = new Config(new Environment());

        $updater = new Updater($this->mockClient, $config, $this->mockIpGrabber);
        $this->assertEquals('test exception', $updater->update());
    }

    public function createMocks(string $subdomain, bool $withException = false)
    {
        $mockDnsEntries = new \stdClass();
        $mockDnsEntries->dnsEntries = [
            new DnsEntry($subdomain, 1, DnsEntry::TYPE_A, 'test value')
        ];

        $this->mockDomainApi = $this->createMock(Domain::class);
        if ($withException) {
            $this->mockDomainApi->method('getInfo')->willThrowException(new \Exception('test exception'));
        } else {
            $this->mockDomainApi->method('getInfo')->willReturn($mockDnsEntries);
        }
        $this->mockDomainApi->method('setDnsEntries')->willReturn(null);

        $this->mockClient = $this->createMock(Client::class);
        $this->mockClient->method('api')->willReturn($this->mockDomainApi);

        $this->mockIpGrabber = $this->createMock(IpGrabber::class);
        $this->mockIpGrabber->method('getCurrentIp')->willReturn('0.0.0.0');
    }
}
