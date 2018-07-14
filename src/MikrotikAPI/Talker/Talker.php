<?php

namespace MikrotikAPI\Talker;

use MikrotikAPI\Core\Connector,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of Talker
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 * @property SentenceUtil $build
 * @property Connector $con
 */
class Talker {

    /**
     * @name Auth
     */
    use \MikrotikAPI\Entity\Auth;

    private $talkerSender;
    private $talkerReciever;
    private $connector;
    private $con;
    public $build;

//        private $param;


    public function __construct() {
        $this->build = new SentenceUtil();
    }

    public function initialize() {
        if ($this->getHost() && $this->getUsername()) {
            $this->connector = new Connector($this->getHost(), $this->getPort(), $this->getUsername(), $this->getPassword());
            if (\version_compare("6.43", $this->getVersion(), ">=")) {
                //conector para versao 6 acima.
                $this->con = $this->connector->connect_v6();
            } else {
                $this->connector->connect();
            }
        }
    }

    /**
     * 
     * @return type
     */
    public function isLogin() {

//        return parent::isLogin();
    }

    /**
     * 
     * @return type
     */
    public function isConnected() {
//        return parent::isConnected();
    }

    /**
     * 
     * @return type
     */
    public function isDebug() {
        return $this->auth->getDebug();
    }

    /**
     * 
     * @return type
     */
    public function isTrap() {
        return $this->reciever->isTrap();
    }

    /**
     * 
     * @return type
     */
    public function isDone() {
        return $this->reciever->isDone();
    }

    /**
     * 
     * @return type
     */
    public function isData() {
        return $this->reciever->isData();
    }

    /**
     * 
     * @param type $sentence
     */
    public function send($sentence = null) {
        $sentence = $sentence ? $sentence : $this->build->getInstance();

        $this->con->talkerSender->send($sentence);
        $this->con->talkerReciever->doRecieving();
    }

    /**
     * 
     * @return type
     */
    public function getResult() {
        return $this->con->talkerReciever->getResult();
    }

}
