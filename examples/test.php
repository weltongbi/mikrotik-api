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

$mk = new MikrotikAPI();
$mk->setDebug(true);
$mk->setResultType('json'); //default is array (array, json, xml)
$mk->setSimple('192.168.100.25', 'admin', '');
$mk->initialize();

if ($mk->isLogin()) {
    $mk->build->addCommand('/ip/address/add');
    $mk->build->setAttribute('address', '10.0.0.1/32');
    $mk->build->setAttribute('interface', 'ether4');
    $mk->send();
    print_r($mk->getResult());
}
