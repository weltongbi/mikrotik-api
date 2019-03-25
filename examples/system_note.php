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
    $mk->setHost('192.168.100.25');
    $mk->setUsername('admin');
    $mk->setPassword('');

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
+++++++ https://welton.dev / Email: weltongbi@gmail.com      +++++++
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
SCRIPT;

    $mk->build->addCommand('/system/note/set');
    $mk->build->setAttribute('note', $template);
    $mk->send();

    print_r($mk->getResult());
} catch (Exception $ex) {
    echo 'Error: ', $ex->getMessage();
}

/* Results:
:::::::::::-MikrotikAPI Debug-:::::::::::
OUT: /login
OUT: =name=admin
OUT: =password=
IN: !done
OUT: /system/note/set
OUT: =note=++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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
IN: !done
    Array()
*/
