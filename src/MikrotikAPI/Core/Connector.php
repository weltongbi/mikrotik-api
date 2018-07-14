<?php

namespace MikrotikAPI\Core;

use MikrotikAPI\Talker\TalkerReciever,
    MikrotikAPI\Talker\TalkerSender,
    MikrotikAPI\Core\Socket,
    MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Util\Util;

/**
 * Description of Connector
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 * @property TalkerSender $talkerSender
 * @property TalkerReciever $talkerReciever
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

    public function isConnected() {
        return $this->connected;
    }

    public function isLogin() {
        return $this->login;
    }

    private function initStream() {
        $this->socket = new Socket($this->host, $this->port);
        $this->talkerSender = new TalkerSender($this->socket);
        $this->talkerReciever = new TalkerReciever($this->socket);
    }

    private function challanger($challange) {
        $chal = md5(chr(0) . $this->password . pack('H*', $challange));
        $login = "/login\n=name=" . $this->username . "\n=response=00" . $chal;
        return $login;
    }

    public function connect() {
        if (true) {
            $this->sender->send("/login");
            $rec = $this->recieveStream();
            if (!Util::contains($rec, "!trap") && count($rec) > 0) {
                if (count($rec) > 1) {
                    $split = explode("=ret=", $rec[1]);
                    $challange = $split[1];
                    $challanger = $this->challanger($challange);
                    $this->sendStream($challanger);
                    $res = $this->recieveStream();
                    if (Util::contains($res, "!done") && !Util::contains($res, "!trap")) {
                        $this->login = TRUE;
                    }
                }
            }
            $this->connected = TRUE;
        } else {
            $this->connected = FALSE;
        }
    }

    /**
     * 
     * @return $this
     */
    public function connect_v6() {
        if ($this->socket->getConnected()) {
            $cmd = new SentenceUtil();
            $cmd->addCommand('/login');
            $cmd->setAttribute('name', $this->username);
            $cmd->setAttribute('password', $this->password);
            $this->talkerSender->send($cmd);

            $this->result = $this->talkerReciever->doRecieving();
            if ($this->result->isDone()) {
                $this->login = TRUE;
            } else {
                $this->login = FALSE;
            }
        }
        return $this;
    }

}
