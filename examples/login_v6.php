<?php

/**
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Examples
 *
 * New v6 is automatically
 */
require '../vendor/autoload.php';

use MikrotikAPI\MikrotikAPI;

try {
    $mk = new MikrotikAPI();
    $mk->setSimple('192.168.100.25', 'admin', '');
    $mk->initialize();

    if ($mk->isLogin()) {
        $mk->build->addCommand('/ip/address/getall');
        $mk->send();
        $teste = $mk->getResult();
        print_r($teste->getResultJson());
    }
} catch (Exception $ex) {
    print_r($ex->getMessage());
}
