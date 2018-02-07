<?php

require_once 'vendor/autoload.php';

use subdee\TransipDnsUpdater\Config;
use subdee\TransipDnsUpdater\Environment;
use subdee\TransipDnsUpdater\IpGrabber;
use subdee\TransipDnsUpdater\Updater;
use TransIP\Client;

$config = new Config(new Environment());
$keypair = trim(file_get_contents(__DIR__ . '/transip.key'));

$updater = new Updater(new Client($config->user, $keypair), $config, new IpGrabber());
echo $updater->update();
