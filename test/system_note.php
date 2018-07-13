<?php

/*
 * Este codigo foi desenvolvidor por welton castro.
 * Email: weltongbi@gmail.com.
 */

require '../vendor/autoload.php';

use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Entity\Auth;
use MikrotikAPI\Commands\System\System;

$auth = new Auth();
$auth->setHost("192.168.100.25");
$auth->setUsername("admin");
$auth->setPassword("");


$talker = new Talker($auth);

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

$note = new System($talker);
\print_r($note->set_note($template));
