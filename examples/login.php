<?php

/*
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Examples
 *
 */
require '../vendor/autoload.php';

use MikrotikAPI\MikrotikAPI;

try {
    $mk = new MikrotikAPI();
    $mk->setDebug(true);
    $mk->setResultType('json');
    $mk->setSimple('192.168.100.25', 'admin', '');
    $mk->initialize();

    if ($mk->isLogin()) {
        print_r('Login OK!');
    }
} catch (Exception $ex) {
    print_r($ex->getMessage());
}

/* Results
:::::::::::-MikrotikAPI Debug-:::::::::::
OUT: /login
OUT: =name=admin
OUT: =password=
IN: !done
Login OK!
*/
