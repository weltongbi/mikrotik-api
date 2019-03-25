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
    //$mk->setDebug(true);
    $mk->setSimple('192.168.100.25', 'admin', '');
    //$mk->setResultType('json');
    $mk->setResultType('array'); //optional
    //$mk->setResultType('xml');
    $mk->initialize();
    //print_r($mk->ip->firewall->address_list->getAll());
    print_r($mk->ip->firewall->address_list->set(['list' => 'intra_tolerancia', 'address' => '10.10.10.2']));
    //print_r($mk->file->remove('*1F01173F'));
} catch (Exception $ex) {
    echo $ex->getMessage();
}
