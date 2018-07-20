<?php

namespace MikrotikAPI\Core;

use MikrotikAPI\Talker\TalkerReciever,
    MikrotikAPI\Talker\TalkerSender,
    MikrotikAPI\Core\Socket,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of Connector
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 * @property TalkerSender $talkerSender
 * @property TalkerReciever $talkerReciever
 * @property TalkerReciever $result
 * @property SentenceUtil $buid
 * 
 * Editado por:
 * @author Welton castro <weltongbi@gmail.com>
 */
class Connector {

    /**
     *
     * @var Socket
     */
    private $socket;
    public $talkerSender;
    public $talkerReciever;
    private $host;
    private $port;
    private $username;
    private $password;
    private $login = FALSE;
    public $result;

    public function __construct($host, $port, $username, $password) {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->initStream();
    }

    private function initStream() {
        $this->socket = new Socket($this->host, $this->port);
        $this->talkerSender = new TalkerSender($this->socket);
        $this->talkerReciever = new TalkerReciever($this->socket);
    }

    public function isConnected() {
        return $this->socket->getConnected();
    }

    /**
     * 
     * @return boolean
     */
    public function isLogin() {
        return $this->login;
    }

    public function getsocket() {
        return $this->socket;
    }

    private function challanger($challange) {
        $chal = md5(chr(0) . $this->password . pack('H*', $challange));
        return "00" . $chal;
    }

    public function connect() {
        if ($this->socket->getConnected()) {
            //pre commando get challanger
            $cmd = new SentenceUtil();
            $cmd->addCommand('/login');
            $this->talkerSender->send($cmd);
            $this->talkerReciever->doRecieving();
            //check receive 'ret'
            if ($this->talkerReciever->isDone() && $this->talkerReciever->getRet()) {
                $rec = new SentenceUtil();
                $rec->addCommand('/login');
                $rec->setAttribute('name', $this->username);
                $rec->setAttribute('response', $this->challanger($this->talkerReciever->getRet()));
                $this->talkerSender->send($rec);

                $this->talkerReciever->doRecieving(); //receive new;                
                //check login is ok
                if ($this->talkerReciever->isDone()) { //receive '!done' is ok
                    $this->login = TRUE;
                }
                if ($this->talkerReciever->isTrap()) {
                    throw new \Exception($this->talkerReciever->getTrapMessage());
                }
            }
        }
        return $this;
    }

    /**
     * 
     * @return $this
     */
    public function connect_v6() {
        if ($this->socket->getConnected()) {
            //commando for login
            $cmd = new SentenceUtil();
            $cmd->addCommand('/login');
            $cmd->setAttribute('name', $this->username);
            $cmd->setAttribute('password', $this->password);
            $this->talkerSender->send($cmd);
            $this->talkerReciever->doRecieving();
            
            //check login is ok
            if ($this->talkerReciever->isDone()) { //receive '!done' is ok
                $this->login = TRUE;
            }
            if ($this->talkerReciever->isTrap()) {
                throw new \Exception($this->talkerReciever->getTrapMessage());
            }
        }
        return $this;
    }

}
