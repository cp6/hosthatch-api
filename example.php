<?php
require __DIR__ . '/vendor/autoload.php';

use Corbpie\HostHatchAPI\HostHatch;

$hh = new HostHatch();

$hh->debug_request = false;

//echo json_encode($hh->getProducts());
echo json_encode($hh->getServers());