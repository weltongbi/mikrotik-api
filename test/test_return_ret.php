<?php

require '../vendor/autoload.php';

use MikrotikAPI\MikrotikAPI;

$mk = new MikrotikAPI();
$mk->setDebug(true);
$mk->setSimple("192.168.100.25", "admin", "");
$mk->initialize();

if ($mk->isLogin()) {
    $mk->build->addCommand("/ip/address/add");
    $mk->build->setAttribute('address', '10.0.0.1/32');
    $mk->build->setAttribute('interface', 'ether4');
    $mk->send();
    if ($mk->do->isDone()) {
        echo $mk->do->getRet();
    }
    if($mk->do->isTrap()){
        echo $mk->do->getTrapMessage();
    }
}