<?php

/*
 * Este codigo foi desenvolvidor por welton castro.
 * Email: weltongbi@gmail.com.
 */
require '../vendor/autoload.php';

use MikrotikAPI\MikrotikAPI;

try {
    $mk = new MikrotikAPI();
    $mk->setSimple("192.168.100.25", "admin", "");
    $mk->initialize();

    if ($mk->isLogin()) {
        $mk->build->addCommand("/ip/address/getall");
        $mk->send();
        $teste = $mk->getResult();
        print_r($teste->getResultJson());
    }
} catch (Exception $ex) {

    print_r($ex->getMessage());
}