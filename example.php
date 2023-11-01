<?php
require __DIR__ . '/vendor/autoload.php';

use Corbpie\HostHatchAPI\HostHatch;

$hh = new HostHatch();

$hh->setApiKey('XXXX-XXXX-XXXX');

echo json_encode($hh->getServers());