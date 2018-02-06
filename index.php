<?php

require_once 'vendor/autoload.php';

use subdee\TransipDnsUpdater\Config;
use subdee\TransipDnsUpdater\Updater;

$config = new Config();
$keypair = trim(file_get_contents(__DIR__ . '/transip.key'));

$updater = new Updater($config, $keypair);
echo $updater->update();
