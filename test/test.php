<?php

require '../vendor/autoload.php';

use MikrotikAPI\MikrotikAPI;


$mk = new MikrotikAPI();
$mk->talker->setSimple("192.168.100.25", "admin", "");
$mk->talker->initialize();
$mk->talker->build->addCommand("/ip/address/getall");

$mk->talker->send();
print_r($mk->talker->getResult());

//$mk->talker->initialize();
//$auth = new Auth();
//$auth->setHost("192.168.100.25");
//$auth->setUsername("admin");
//$auth->setPassword("");
//$auth->setDebug(true);
//
//
//$talker = new Talker($auth);
////$filter = new FirewallFilter($talker);
////$a = $filter->getAll();
//
//
//$ipaddr = new Address($talker);
//$listIP = $ipaddr->getAll();
//\print_r($listIP);

//$scripts = new SystemScheduler($talker);
//\print_r($scripts->getAll());

//MikrotikAPI\Util\DebugDumper::dump($listIP);
