<?php

require '../vendor/autoload.php';

use MikrotikAPI\MikrotikAPI;

$mk = new MikrotikAPI();
$mk->setDebug(true);
$mk->setSimple("192.168.100.25", "admin", "");
$mk->initialize();

if ($mk->isLogin()) {
    $mk->build->addCommand("/ip/firewall/nat/print");
    $mk->build->where('chain', '=', 'dstnat');
    
    $mk->send();    
    //print_r());
    print_r($mk->getResult());
}