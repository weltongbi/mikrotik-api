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
$mk->setSimple('192.168.100.25', 'admin', '');
$mk->initialize();

if ($mk->isLogin()) {
    $mk->build->addCommand('/ip/address/add');
    $mk->build->setAttribute('address', '10.0.0.1/32');
    $mk->build->setAttribute('interface', 'ether4');
    $mk->send();
    if ($mk->do->isDone()) {
        echo $mk->do->getRet();
    }
    if ($mk->do->isTrap()) {
        echo $mk->do->getTrapMessage();
    }
}

/* Returns
isDone
:::::::::::-MikrotikAPI Debug-:::::::::::
OUT: /login
OUT: =name=admin
OUT: =password=
IN: !done
OUT: /ip/address/add
OUT: =address=10.0.0.1/32
OUT: =interface=ether4
IN: !done
IN: =ret=*28E

*28E

isTrap
:::::::::::-MikrotikAPI Debug-:::::::::::
OUT: /login
OUT: =name=admin
OUT: =password=
IN: !done
OUT: /ip/address/add
OUT: =address=10.0.0.1/32
OUT: =interface=ether4
IN: !trap
IN: =message=failure: already have such address
failure: already have such address

*/
