<?php

require '../vendor/autoload.php';

use MikrotikAPI\MikrotikAPI;

$mk = new MikrotikAPI();
$mk->setVersion('7');
$mk->setSimple("192.168.100.25", "admin", "");
$mk->initialize();

if ($mk->isLogin()) {
    $mk->build->addCommand("/ip/address/getall");
    $mk->send();    
    $teste = $mk->getResult();
    print_r($teste->getResultJson());
}