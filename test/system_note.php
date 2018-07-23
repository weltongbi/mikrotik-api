<?php

/*
 * Este codigo foi desenvolvidor por welton castro.
 * Email: weltongbi@gmail.com.
 */

require '../vendor/autoload.php';
use MikrotikAPI\MikrotikAPI;

$mk = new MikrotikAPI();
$mk->setHost("192.168.100.25");
$mk->setUsername("admin");
$mk->setPassword("");

$mk->initialize();

//test sent to note mikrotik
$template = <<<'SCRIPT'
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
......./xxx..API......xxxx\.
....../xxxx....PHP....xxxxx/....\___
...../xxxx..MIKROTIK..xxxx|.......\....\
....|xxxx........xxxx |............|
....|xxxxxx..........xxxxx/.....o......|.....__
.....|xxxxxxxxxxxxxxxx\......>..../...../.../
..../...........................\__\...../__/.../
.///..\........_____.....__/...\______/
......|...........||...........|
......|___|__)|___|__)
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+++++++ Nome: Welton Castro                                  +++++++
+++++++ Cel: (77) 9.9940-2201/WhatsApp                       +++++++
+++++++ https://intranet.br.com / Email: weltongbi@gmail.com +++++++
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
SCRIPT;

$mk->build->addCommand('/');
