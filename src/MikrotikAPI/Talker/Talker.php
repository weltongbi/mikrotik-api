<?php

namespace MikrotikAPI\Talker;

use MikrotikAPI\Core\Connector,
    MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Util\ResultUtil;

/**
 * Description of Talker
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 * @property Connector $con
 */
class Talker {

    use \MikrotikAPI\Entity\Auth;

    private $talkerSender;
    private $talkerReciever;
    private $con;
    /**
     *
     * @var SentenceUtil 
     */
    public $build;
    /**
     *
     * @var TalkerReciever 
     */
    public $do;
    private $socket;

    /**
     * Istance the Talker;
     */
    private static $instance;

    public function __construct() {
        self::$instance = & $this;

        $this->build();
    }

    private function build() {
        $this->build = new SentenceUtil();
    }

    public function initialize() {
        if ($this->getHost() && $this->getUsername()) {
            $connector = new Connector($this->getHost(), $this->getPort(), $this->getUsername(), $this->getPassword(), $this);
            $this->socket = $connector->getsocket();
            $this->con = $connector->connect();
        }
    }

    /**
     * 
     * @return boolean
     */
    public function isLogin() {
        if ($this->socket) {
            return $this->con->isLogin();
        }
        throw new \Exception("Erro: Not connected, call function 'Talker->initialize'");
    }

    /**
     * 
     * @return type
     */
    public function isConnected() {
        if ($this->socket) {
            return $this->socket->isConnected();
        }
        throw new \Exception('Not connected, call function "Talker->initialize"');
    }

    /**
     * 
     * @param type $sentence
     */
    public function send($sentence = null) {
        $this->isLogin(); //check login is ok!
        $this->con->talkerSender->send($sentence ? $sentence : $this->build->getInstance());
        $this->con->talkerReciever->doRecieving();
        $this->do = $this->con->talkerReciever->getInstance();
        //reset build
        $this->build();
    }

    /**
     * 
     * @return ResultUtil
     */
    public function getResult() {
        $this->isLogin(); //check login is ok!

        $result = $this->con->talkerReciever->getResult();

        if (defined('MK_RESULT_TYPE')) {
            switch (strtoupper(constant('MK_RESULT_TYPE'))) {
                case 'JSON':
                    return $result->getResultJson();
                case 'ARRAY':
                    return $result->getResultArray();
                case 'XML':
                    return $result->getResultXml();
            }
        }
        return $result->getResultArray();
    }

    /**
     * 
     * @return Talker
     */
    public function &get_instance() {
        return self::$instance;
    }

}
