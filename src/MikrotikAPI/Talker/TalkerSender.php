<?php

namespace MikrotikAPI\Talker;

use MikrotikAPI\Core\Socket;
use MikrotikAPI\Core\StreamSender;
use MikrotikAPI\Util\SentenceUtil;
use MikrotikAPI\Entity\Attribute;
use MikrotikAPI\Util\Util;
use MikrotikAPI\Util\DebugDumper;

/**
 * Description of TalkerSender.
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Libraries
 */
class TalkerSender
{
    private $debug = false;
    private $socket;

    public function __construct(Socket $socket)
    {
        $this->socket = $socket;
    }

    /**
     * @param SentenceUtil $sentence estancia da classe SentenceUtil
     */
    public function send(SentenceUtil $sentence)
    {
        $cmd = $this->createSentence($sentence);
        $streamSender = new StreamSender($this->socket);
        $streamSender->send($cmd);
    }

    public function isDebug()
    {
        return $this->debug;
    }

    public function setDebug($boolean)
    {
        $this->debug = $boolean;
    }

    public function runDebugger($str)
    {
        if ($this->isDebug()) {
            DebugDumper::dump($str);
        }
    }

    private function sentenceWrapper(SentenceUtil $sentence)
    {
        $it = $sentence->getBuildCommand()->getIterator();

        $attr = new Attribute();
        while ($it->valid()) {
            if (Util::contains($it->current()->getClause(), 'commandPrint') ||
                    Util::contains($it->current()->getClause(), 'commandReguler')) {
                $attr = $it->current();
            }
            $it->next();
        }

        $it->rewind();

        $out = new \ArrayObject();
        $out->append($attr);
        while ($it->valid()) {
            if (!Util::contains($it->current()->getClause(), 'commandPrint') &&
                    !Util::contains($it->current()->getClause(), 'commandReguler')) {
                $out->append($it->current());
            }
            $it->next();
        }

        return $out;
    }

    private function createSentence(SentenceUtil $sentence)
    {
        $build = [];
        $sentence = $this->sentenceWrapper($sentence);
        $it = $sentence->getIterator();
        $cmd = '';

        while ($it->valid()) {
            $clause = $it->current()->getClause();
            $name = $it->current()->getName();
            $value = $it->current()->getValue();

            if (Util::contains($clause, 'commandPrint')) {
                $build[] = $value;
                $cmd = 'print';
            } elseif (Util::contains($clause, 'commandReguler')) {
                $build[] = $value;
                $cmd = 'reguler';
            } else {
                if (Util::contains($name, 'proplist') || Util::contains($name, 'tag')) {
                    $build[] = '=.'.$name.'='.$value;
                } elseif ($clause == 'where' && $cmd == 'print') {
                    $build[] = '?'.$name.$value;
                } elseif ($clause == 'where' && $cmd == 'reguler') {
                    $build[] = $name.$value;
                } elseif ($clause == 'whereNot' || $clause == 'orWhere' ||
                        $clause == 'orWhereNot' || $clause == 'andWhere' ||
                        $clause == 'andWhereNot') {
                    $build[] = $name.$value;
                } elseif ($clause == 'setAttribute') {
                    $build[] = '='.$name.'='.$value;
                }
            }
            $it->next();
        }
        $this->runDebugger($build);

        return $build;
    }
}
