<?php

namespace MikrotikAPI\Commands\System;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Talker\Talker;

/**
 * Description of Mapi_System
 *
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class System {

    /**
     *
     * @var type array
     */
    private $talker;

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

    /**
     * This method is used to set system identity
     * @param string $name 
     * @return string
     */
    public function set_identity($name) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/system/identity/set");
        $sentence->setAttribute("name", $name);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method is used to display all system  identiy
     * @return array
     */
    public function get_all_identity() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/system/identity/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        return $rs->getResultArray();
    }

    /**
     * This method is used to display all system clock
     * @return array
     */
    public function get_all_clock() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/system/clock/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        }
    }

    /**
     * This method is used to system bacup save
     * @param string $name 
     * @return string
     */
    public function save_backup($name) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/system/backup/save");
        $sentence->setAttribute("name", $name);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method is used to system backup load
     * @param string $name backup name
     * @return string
     */
    public function load_backup($name) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/system/backup/load");
        $sentence->setAttribute("name", $name);
        $this->talker->send($sentence);
        return "Sucsess";
    }

    /**
     * This method is used to display all system history
     * @return array|string
     */
    public function get_all_history() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/system/history/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No History";
        }
    }

    /**
     * This method is used to display all system license
     * @return array
     */
    public function get_all_license() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/system/license/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        }
    }

    /**
     * This method is used to display all system routerboard
     * @return array
     */
    public function get_all_routerboard() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/system/routerboard/getall");
        $this->talker->send($sentence);
        $rs = $this->talker->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        }
    }

    /**
     * En: This method is used to system reset configuration
     * Br: Método usado para resetar as configurações
     * @param string $keep_users  (yes or no)
     * @param string $no_defaults (yes or no)
     * @param string $skip_backup (yes or no)
     * @return string
     */
    public function reset($keep_users, $no_defaults, $skip_backup) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/address/add");
        $sentence->setAttribute("keep-users", $keep_users);
        $sentence->setAttribute("no-defaults", $no_defaults);
        $sentence->setAttribute("skip-backup", $skip_backup);
        $this->talker->send($sentence);
        return "Sucsess";
    }
    /**
     * En: This method is used to set system note
     * Br: Método usado para setar a nota do sistema
     * @param string $text 
     * @param string $show_at_login (yes or no)
     * @return string
     */
    public function set_note($text, $show_at_login = "yes") {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/system/note/set");
        $sentence->setAttribute("show-at-login", $show_at_login);
        $sentence->setAttribute("note", $text);
        $this->talker->send($sentence);
        return "Sucsess";
    }

}
