<?php

require '../vendor/autoload.php';

use MikrotikAPI\MikrotikAPI;

/*
 * Este codigo foi desenvolvidor por welton castro.
 * Email: weltongbi@gmail.com.
 */
try {
    $mk = new MikrotikAPI();
    $mk->setDebug(true);
    $mk->setDebug(true);
    $mk->setSimple("192.168.100.25", "admin", "");
    $mk->initialize();

    $mk->build->addCommand('/ip/firewall/filter/getall');
    //$mk->build->where('chain', '?', 'forward');
    $mk->send();
    print_r($mk->getResult());
    
} catch (Exception $ex) {
    echo $ex->getMessage();
}

