<?php

namespace MikrotikAPI\Commands\IP\Hotspot;

use MikrotikAPI\Talker\Talker,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of Hosts
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class Host {

    /**
     *
     * @var Talker
     */
    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    /**
     * This method is used to delete hotspot by id
     * @param string $id 
     * @return array
     * 
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/host/remove");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     * This method is used to display all hotspot
     * @return type array
     * 
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/host/getall");
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     * This method is used to display hotspot host
     * in detail based on the id
     * @param string $id
     * @return type array
     *  
     */
    public function detail($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/host/print");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

}
