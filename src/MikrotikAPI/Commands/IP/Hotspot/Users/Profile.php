<?php

namespace MikrotikAPI\Commands\IP\Hotspot\Users;

use MikrotikAPI\Talker\Talker,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of UsersProfile
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category name
 */
class Profile {

    /**
     *
     * @var Talker
     */
    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    /**
     * This function is used to add hotspot user p
     * @return type array
     */
    public function add($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/user/profile/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     * This method is used to delete hotspot user profile by id
     * @param type $id string
     * @return type array
     * 
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/user/profile/remove");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     * This method is used to enable hotspot user profile by id
     * @param type $id string
     * @return type array
     * 
     */
    public function enable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/user/profile/enable");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     * This method is used to disable hotspot user profile by id
     * @param type $id string
     * @return type array
     * 
     */
    public function disable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/user/profile/disable");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     * This method is used to set or edit by id
     * @param type $param array
     * @param type $id string
     * @return type array
     * 
     */
    public function set($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/user/profile/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     * This method is used to display all hotspot user profile
     * @return type array
     * 
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/user/profile/getall");
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     * This method is used to display hotspot user profile
     * in detail based on the id
     * @param string $id
     * @return array
     *  
     */
    public function detail($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/user/profile/print");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

}
