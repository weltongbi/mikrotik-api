<?php

namespace MikrotikAPI\Talker;

use MikrotikAPI\Core\Socket,
    MikrotikAPI\Core\StreamReciever,
    MikrotikAPI\Util\ResultUtil,
    MikrotikAPI\Util\Util,
    MikrotikAPI\Entity\Attribute,
    MikrotikAPI\Util\DebugDumper;

/**
 * Description of TalkerReciever
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 * @property ResultUtil $result Result raw
 */
class TalkerReciever {

    private $socket;
    private $result;
    private $trap = FALSE;
    private $done = FALSE;
    private $doneMsg;
    private $re = FALSE;
    private $debug = FALSE;

    public function __construct(Socket $socket) {
        $this->socket = $socket;
    }

    public function isTrap() {
        return $this->trap;
    }

    public function getTrapMessage() {
        if ($this->isTrap()) {
            return $this->result->getResult("message");
        }
        return FALSE;
    }

    public function isDone() {
        return $this->done;
    }

    public function getRet() {
        if ($this->isDone()) {
            return $this->result->getResult("ret");
        }
        return FALSE;
    }

    public function getTag() {
        if ($this->isDone()) {
            return $this->result->getResult(".tag");
        }
        return FALSE;
    }

    public function isData() {
        return $this->re;
    }

    public function isDebug() {
        return $this->debug;
    }

    public function setDebug($boolean) {
        $this->debug = $boolean;
    }

    private function parseRawToList($raw) {
        if (!empty($raw)) {
            $list = new \ArrayObject();
            foreach ($raw as $value) {
                $attr = new Attribute();

                if (in_array($value, array('!fatal', '!re', '!trap'))) {
                    continue;
                }

                if (\preg_match('/^=([^=]+)=(.*)$/sS', $value, $MATCHES)) {
                    if ($MATCHES[1]) {
                        $attr->setName($MATCHES[1]);
                        $attr->setValue(isset($MATCHES[2]) ? $MATCHES[2] : \NULL);
                    }
                }
                $list->append($attr);
            }

            if ($list->count() != 0) {
                $this->result->add($list);
            }
        }
    }

    /**
     * 
     * @return ResultUtil
     */
    public function getResult() {
        return $this->result;
    }

    public function doRecieving() {
        $this->run();
    }

    private function run() {
        $this->result = new ResultUtil();
        $conn = new StreamReciever($this->socket->getSocket());
        $s = "";
        while (true) {
            $s = $conn->reciever();
            if (Util::contains($s, "!re")) {
                $this->parseRawToList($s);
                $this->re = TRUE;
            }

            if (Util::contains($s, "!trap")) {
                $this->trap = TRUE;
                if (count($s) > 1) {
                    $this->parseRawToList($s);
                }
                break;
            }

            if (Util::contains($s, "!done")) {
                $this->done = TRUE;
                if (count($s) > 1) {
                    $this->parseRawToList($s);
                }
                break;
            }
        }
    }

}
