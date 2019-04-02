<?php

namespace MikrotikAPI;

use MikrotikAPI\Commands\File\File;
use MikrotikAPI\Commands\Interfaces\Interfaces;
use MikrotikAPI\Commands\IP\IP;
use MikrotikAPI\Commands\PPP\PPP;
use MikrotikAPI\Commands\System\System;
use MikrotikAPI\Talker\Talker;

/**
 * Description of Mikrotik_Api.
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Libraries
 *
 * @property File       $file       /file
 * @property IP         $ip         /ip
 * @property Interfaces $interfaces /interfaces
 * @property PPP        $ppp        /ppp
 * @property System     $system     /system
 */
class MikrotikAPI extends Talker
{
    const MK_DEFAULT_RESULT = 'array';

    private $class = [
        'file' => 'MikrotikAPI\Commands\File',
        'ip' => 'MikrotikAPI\Commands\IP\IP',
        'interfaces' => 'MikrotikAPI\Commands\Interfaces\Interfaces',
        'ppp' => 'MikrotikAPI\Commands\PPP\PPP',
        'system' => 'MikrotikAPI\Commands\System\System',
        'user' => 'MikrotikAPI\Commands\User',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function __get($name)
    {
        if ($this->class[$name]) {
            $class = $this->class[$name];

            return new $class($this->get_instance());
        }
        throw new \Exception('The method not exist');
    }

    public function setDebug($v)
    {
        if (!defined('MK_DEBUG') && $v) {
            define('MK_DEBUG', $v);
            echo ':::::::::::-MikrotikAPI Debug-:::::::::::'.PHP_EOL;
        }
    }

    public function setResultType($type)
    {
        if (!defined('MK_RESULT_TYPE')) {
            define('MK_RESULT_TYPE', $type);
        }
    }
}
