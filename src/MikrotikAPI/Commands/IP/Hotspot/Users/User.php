<?php

namespace MikrotikAPI\Commands\IP\Hotspot\Users;

use MikrotikAPI\Talker\Talker;
use MikrotikAPI\Util\SentenceUtil;

/**
 * Description of Users.
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category name
 *
 * @property Profile $profile Profile User
 */
class User
{
    /**
     * @var Talker
     */
    private $talker;
    private $class = [
        'profile' => 'MikrotikAPI\Commands\IP\Hotspot\Users\Profile',
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
        throw new \Exception('The method not exist in HotSpot/Users');
    }

    /**
     * This function is used to add hotspot.
     *
     * @return type array
     */
    public function add($param)
    {
        $sentence = new SentenceUtil();
        $sentence->addCommand('/ip/hotspot/user/add');
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->talker->send($sentence);

        return $this->talker->getResult();
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
        $sentence->addCommand('/ip/hotspot/user/remove');
        $sentence->where('.id', '=', $id);
        $this->talker->send($sentence);

        return $this->talker->getResult();
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
        $sentence->addCommand('/ip/hotspot/user/enable');
        $sentence->where('.id', '=', $id);
        $this->talker->send($sentence);

        return $this->talker->getResult();
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
        $sentence->addCommand('/ip/hotspot/user/disable');
        $sentence->where('.id', '=', $id);
        $this->talker->send($sentence);

        return $this->talker->getResult();
    }

    /**
     * This method is used to reset uptime and trafic counters for hotspot by id.
     *
     * @param type $id string
     *
     * @return type array
     */
    public function resetCounter($id)
    {
        $sentence = new SentenceUtil();
        $sentence->addCommand('/ip/hotspot/user/reset-counter');
        $sentence->where('.id', '=', $id);
        $this->talker->send($sentence);

        return $this->talker->getResult();
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
        $sentence->addCommand('/ip/hotspot/user/set');
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
        $sentence->fromCommand('/ip/hotspot/user/getall');
        $this->talker->send($sentence);

        return $this->talker->getResult();
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
        $sentence->fromCommand('/ip/hotspot/user/print');
        $sentence->where('.id', '=', $id);
        $this->talker->send($sentence);

        return $this->talker->getResult();
    }
}
