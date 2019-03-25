<?php

namespace MikrotikAPI\Commands\IP\Hotspot;

use MikrotikAPI\Talker\Talker,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of ServicePort
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class ServicePort {

    /**
     *
     * @var Talker $talker
     */
    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    /**
     * This method used for get all Ip Firewall Service Port
     * @return array
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/firewall/service-port/getall");
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     * This method used for disable Ip Firewall Service Port
     * @param type $id string
     * @return type array
     */
    public function disable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/firewall/service-port/disable");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     * This method used for enable Ip Firewall Service Port
     * @param type $id string
     * @return type array
     */
    public function enable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/firewall/service-port/enable");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     *
     * @param type $id string 
     * @return type array
     * 
     */
    public function detail($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/firewall/service-port/print");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

}
