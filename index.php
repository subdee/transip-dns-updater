<?php

use Symfony\Component\Yaml\Yaml;

require_once 'vendor/autoload.php';

$config = (object)Yaml::parseFile('config.yml');

$client = new \TransIP\Client($config->user, trim(file_get_contents($config->keyfile)));
try {
    $domainApi = $client->api('domain');
    $currentIp = trim(file_get_contents('http://icanhazip.com'));

    /** @var TransIP\Model\DnsEntry[] $dnsEntries */
    $dnsEntries = $domainApi->getInfo($config->domain)->dnsEntries;

    $key = array_search($config->subdomain, array_column($dnsEntries, 'name'));

    if ($key === false) {
        $dnsEntries[] = new \TransIP\Model\DnsEntry($config->subdomain, 86400, \TransIP\Model\DnsEntry::TYPE_A,
            $currentIp);
    } else {
        $dnsEntries[$key]->content = $currentIp;
    }

    $domainApi->setDnsEntries($config->domain, $dnsEntries);
} catch (\Exception $e) {
    echo $e->getMessage();
}


