<?php

namespace MikrotikAPI;
use MikrotikAPI\Talker\Talker;
/**
 * Description of Mikrotik_Api
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class MikrotikAPI {

    /**
     * Instantiation of Class Mikrotik_Api
     * @access private
     * @var type array
     */
    private $param;

    /**
     *
     * @var Talker
     */
    public $talker;

    function __construct($param = array()) {
        $this->talker = new Talker;
    }
    

    /**
     * This method for call class Mapi IP
     * @access public
     * @return Object of Mapi_Ip 
     */
    public function IP() {
        return new Mapi_Ip($this->talker);
    }

    /**
     * This method for call class Mapi Interface
     * @access public
     * @return Object of Mapi_Interface 
     */
    public function interfaces() {
        return new Mapi_Interfaces($this->talker);
    }

    /**
     * This method for call class Mapi Ppp
     * @access public
     * @return Object of Mapi_Ppp
     */
    public function ppp() {
        return new Mapi_Ppp($this->talker);
    }

    /**
     * This method for call class Mapi_System
     * @access public
     * @return Mapi_System 
     */
    public function system() {
        return new Mapi_System($this->talker);
    }

    /**
     * This method for call class Mapi_File
     * @access public
     * @return Mapi_File 
     */
    public function file() {
        return new Mapi_File($this->talker);
    }

    /**
     * This metod used call class Mapi_System_Scheduler 
     * @return Mapi_Ip
     */
    public function system_scheduler() {
        return new Mapi_System_Scheduler($this->talker);
    }

    /**
     * 
     * @return \Talker
     */
    public function buildCommand() {
        return new Talker($this->param['host'], $this->param['port'], $this->param['username'], $this->param['password']);
    }

}
