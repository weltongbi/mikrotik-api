<?php

namespace MikrotikAPI;

use MikrotikAPI\Talker\Talker,
    MikrotikAPI\Commands\File\File,
    MikrotikAPI\Commands\IP\IP,
    MikrotikAPI\Commands\Interfaces\Interfaces,
    MikrotikAPI\Commands\PPP\PPP,
    MikrotikAPI\Commands\System\System;

/**
 * Description of Mikrotik_Api
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 * @property File $file /file
 * @property IP $ip /ip
 * @property Interfaces $interfaces /interfaces
 * @property PPP $ppp /ppp
 * @property System $system /system
 */
class MikrotikAPI extends Talker {

    const MK_DEFAULT_RESULT = 'array';

    private $class = [
        'file' => 'MikrotikAPI\Commands\File\File',
        'ip' => 'MikrotikAPI\Commands\IP\IP',
        'interfaces' => 'MikrotikAPI\Commands\Interfaces\Interfaces',
        'ppp' => 'MikrotikAPI\Commands\PPP\PPP',
        'system' => 'MikrotikAPI\Commands\System\System',
    ];

    function __construct() {
        parent::__construct();
    }

    public function __get($name) {
        if ($this->class[$name]) {
            $class = $this->class[$name];
            return new $class($this->get_instance());
        }
        throw new Exception('The method not exist');
    }

    public function setDebug($v) {
        if (!defined('MK_DEBUG')) {
            define('MK_DEBUG', $v);
            echo ':::::::::::-MikrotikAPI Debug-:::::::::::' . PHP_EOL;
        }
    }

    public function setResultType($type) {
        if (!defined('MK_RESULT_TYPE')) {
            define('MK_RESULT_TYPE', $type);
        }
    }

}
