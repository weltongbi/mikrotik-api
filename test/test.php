<?php

require '../vendor/autoload.php';

use MikrotikAPI\Talker\Talker;
use \MikrotikAPI\Entity\Auth;
use MikrotikAPI\Commands\IP\Address;
use MikrotikAPI\Commands\IP\Firewall\FirewallFilter;
use \MikrotikAPI\Commands\System\SystemScheduler;


$auth = new Auth();
$auth->setHost("192.168.100.25");
$auth->setUsername("admin");
$auth->setPassword("");
$auth->setDebug(true);


$talker = new Talker($auth);
//$filter = new FirewallFilter($talker);
//$a = $filter->getAll();


$ipaddr = new Address($talker);
$listIP = $ipaddr->getAll();
\print_r($listIP);

//$scripts = new SystemScheduler($talker);
//\print_r($scripts->getAll());

//MikrotikAPI\Util\DebugDumper::dump($listIP);
