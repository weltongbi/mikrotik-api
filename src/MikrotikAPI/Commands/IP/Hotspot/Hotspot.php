<?php

namespace MikrotikAPI\Commands\IP\Hotspot;

use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Commands\IP\Hotspot\Users\User;

/**
 * Description of Hotspot.
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Libraries
 *
 * @property Active       $active        HostSpot Active
 * @property Cookie       $cookie        HostSpot Cookie
 * @property Host         $host          HostSpot Host
 * @property IPBinding    $ip_binding    HostSpot Ip-blinding
 * @property Profile      $profile       HostSpot Profile
 * @property ServicePort  $service_port  HostSpot Service port
 * @property User         $user          HostSpot Users
 * @property walledGarden $walled_garden HostSpot walled Garden
 */
class Hotspot
{
    /**
     * @var Talker
     */
    private $talker;
    private $class = [
        'active' => 'MikrotikAPI\Commands\IP\Hotspot\Active',
        'cookie' => 'MikrotikAPI\Commands\IP\Hotspot\Cookie',
        'host' => 'MikrotikAPI\Commands\IP\Hotspot\Host',
        'ip_binding' => 'MikrotikAPI\Commands\IP\Hotspot\IPBinding',
        'profile' => 'MikrotikAPI\Commands\IP\Hotspot\Profile',
        'service_port' => 'MikrotikAPI\Commands\IP\Hotspot\ServicePort',
        'user' => 'MikrotikAPI\Commands\IP\Hotspot\Users\User',
        'walled_garden' => 'MikrotikAPI\Commands\IP\Hotspot\walledGarden', // o proprio hostport
    ];

    public function __construct(Talker $talker)
    {
        $this->talker = $talker;
    }

    /**
     * @param string $name
     *
     * @return \MikrotikAPI\Commands\IP\Hotspot\$name
     *
     * @throws \Exception
     */
    public function __get($name)
    {
        if ($this->class[$name]) {
            $class = $this->class[$name];

            return new $class($this->talker);
        }
        throw new \Exception('The method not exist in HotSpot');
    }

    /**
     * This function is used to add hotspot.
     *
     * @return type array
     */
    public function add($param)
    {
        $sentence = new SentenceUtil();
        $sentence->addCommand('/ip/hotspot/add');
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->talker->send($sentence);

        return 'Sucsess';
    }

    /**
     * This method is used to delete hotspot by id.
     *
     * @param type $id string
     *
     * @return type array
     */
    public function delete($id)
    {
        $sentence = new SentenceUtil();
        $sentence->addCommand('/ip/hotspot/remove');
        $sentence->where('.id', '=', $id);
        $enable = $this->talker->send($sentence);

        return 'Sucsess';
    }

    /**
     * This method is used to enable hotspot by id.
     *
     * @param type $id string
     *
     * @return type array
     */
    public function enable($id)
    {
        $sentence = new SentenceUtil();
        $sentence->addCommand('/ip/hotspot/enable');
        $sentence->where('.id', '=', $id);
        $enable = $this->talker->send($sentence);

        return 'Sucsess';
    }

    /**
     * This method is used to disable hotspot by id.
     *
     * @param type $id string
     *
     * @return type array
     */
    public function disable($id)
    {
        $sentence = new SentenceUtil();
        $sentence->addCommand('/ip/hotspot/disable');
        $sentence->where('.id', '=', $id);
        $disable = $this->talker->send($sentence);

        return 'Sucsess';
    }

    /**
     * This method is used to set or edit by id.
     *
     * @param type $param array
     * @param type $id    string
     *
     * @return type array
     */
    public function set($param, $id)
    {
        $sentence = new SentenceUtil();
        $sentence->addCommand('/ip/hotspot/set');
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where('.id', '=', $id);
        $this->talker->send($sentence);

        return 'Sucsess';
    }

    /**
     * This method is used to display all hotspot.
     *
     * @return type array
     */
    public function getAll()
    {
        $sentence = new SentenceUtil();
        $sentence->fromCommand('/ip/hotspot/getall');
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return 'No IP Hotspot To Set, Please Your Add IP Hotspot';
        }
    }

    /**
     * This method is used to display hotspot
     * in detail based on the id.
     *
     * @param type $id string
     *
     * @return type array
     */
    public function detail($id)
    {
        $sentence = new SentenceUtil();
        $sentence->fromCommand('/ip/hotspot/print');
        $sentence->where('.id', '=', $id);
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return 'No IP Hotspot With This id = '.$id;
        }
    }
}
