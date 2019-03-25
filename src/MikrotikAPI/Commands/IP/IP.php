<?php

namespace MikrotikAPI\Commands\IP;

use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\IP\Hotspot\Hotspot;
use MikrotikAPI\Commands\IP\Firewall\Firewall;

/**
 * Description of IP.
 *
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category	 Libraries
 *
 * @property Address    $address    Description
 * @property Hotspot    $hotspot    Description
 * @property Pool       $pool       Description
 * @property DNS        $dns        Description
 * @property Firewall   $firewall   Description
 * @property Accounting $accounting Description
 * @property ARP        $arp        Description
 * @property DHCPClient $dhcpclient Description
 * @property DHCPServer $dhcpserver Description
 * @property DHCPRelay  $dhcprelay  Description
 * @property Route      $route      Description
 * @property Service    $service    Description
 * @property WebProxy   $webproxy   Description
 */
class IP
{
    /**
     * @var type array
     */
    private $talker;
    private $class = [
        'address' => 'MikrotikAPI\Commands\IP\Address',
        'hotspot' => 'MikrotikAPI\Commands\IP\Hotspot\Hotspot',
        'pool' => 'MikrotikAPI\Commands\IP\Pool',
        'dns' => 'MikrotikAPI\Commands\IP\DNS',
        'firewall' => 'MikrotikAPI\Commands\IP\Firewall\Firewall',
        'accounting' => 'MikrotikAPI\Commands\IP\Accounting',
        'arp' => 'MikrotikAPI\Commands\IP\ARP',
        'dhcpclient' => 'MikrotikAPI\Commands\IP\DHCPClient',
        'dhcpserver' => 'MikrotikAPI\Commands\IP\DHCPServer',
        'dhcprelay' => 'MikrotikAPI\Commands\IP\DHCPRelay',
        'route' => 'MikrotikAPI\Commands\IP\Route',
        'service' => 'MikrotikAPI\Commands\IP\Service',
        'webproxy' => 'MikrotikAPI\Commands\IP\WebProxy',
    ];

    public function __construct(Talker $talker)
    {
        $this->talker = $talker;
    }

    public function __get($name)
    {
        if ($this->class[$name]) {
            $class = $this->class[$name];

            return new $class($this->talker);
        }
        throw new \Exception('The method not exist');
    }
}
