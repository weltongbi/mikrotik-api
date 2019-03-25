<?php

namespace MikrotikAPI\Commands\IP\Firewall;

use MikrotikAPI\Talker\Talker;

/**
 * Description of Firewall.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2018 - 2019
 *
 * @see welton.dev
 *
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Commands
 *
 * @property AddressList    $address_list    Instance IP\Firewall\AddressList
 * @property Connection     $connection      Instance IP\Firewall\Connection
 * @property Filter         $filter          Instance IP\Firewall\Filter
 * @property Layer7Protocol $layer7_protocol Instance IP\Firewall\Layer7Protocol
 * @property Mangle         $mangle          Instance IP\Firewall\Mangle
 * @property NAT            $nat             Instance IP\Firewall\NAT
 * @property Raw            $raw             Instance IP\Firewall\Raw
 * @property ServicePort    $service_port    Instance IP\Firewall\ServicePort
 */
class Firewall
{
    /**
     * @var type array
     */
    private $talker;
    private $class = [
        'address_list' => 'MikrotikAPI\Commands\IP\Firewall\AddressList',
        'connection' => 'MikrotikAPI\Commands\IP\Firewall\Connection',
        'filter' => 'MikrotikAPI\Commands\IP\Firewall\Filter',
        'layer7_protocol' => 'MikrotikAPI\Commands\IP\Firewall\Layer7Protocol',
        'mangle' => 'MikrotikAPI\Commands\IP\Firewall\Mangle',
        'nat' => 'MikrotikAPI\Commands\IP\Firewall\NAT',
        'raw' => 'MikrotikAPI\Commands\IP\Firewall\Raw',
        'service_port' => 'MikrotikAPI\Commands\IP\Firewall\ServicePort',
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
