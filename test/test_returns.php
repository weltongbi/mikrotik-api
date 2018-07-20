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
    $mk->setSimple("192.168.100.25", "intranet", "123");
    $mk->initialize();

    print_r($mk->ip->firewall->address_list->getAll());
    
} catch (Exception $ex) {
    echo $ex->getMessage();
}

