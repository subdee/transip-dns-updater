<?php

namespace subdee\TransipDnsUpdater;

use TransIP\Client;
use TransIP\Model\DnsEntry;

class Updater
{
    private $config;
    private $client;
    private $ipGrabber;

    public function __construct(Client $client, Config $config, IpGrabber $ipGrabber)
    {
        $this->config = $config;
        $this->client = $client;
        $this->ipGrabber = $ipGrabber;
    }

    public function update()
    {
        try {
            $domainApi = $this->client->api('domain');
            $currentIp = $this->ipGrabber->getCurrentIp();

            /** @var DnsEntry[] $dnsEntries */
            $dnsEntries = $domainApi->getInfo($this->config->domain)->dnsEntries;

            $key = array_search($this->config->subdomain, array_column($dnsEntries, 'name'));

            if ($key === false) {
                $dnsEntries[] = new DnsEntry(
                    $this->config->subdomain,
                    86400,
                    DnsEntry::TYPE_A,
                    $currentIp
                );
            } else {
                $dnsEntries[$key]->content = $currentIp;
            }

            return $domainApi->setDnsEntries($this->config->domain, $dnsEntries);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
