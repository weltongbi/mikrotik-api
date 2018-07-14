<?php

/*
 * Este codigo foi desenvolvidor por welton castro.
 * Email: weltongbi@gmail.com.
 */

namespace MikrotikAPI\Core;

/**
 * Description of Socket
 *
 * @author welton
 */
class Socket {

    private $socket;
    private $connected = FALSE;

    public function __construct($host, $port) {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);        
        
        //socket_set_option($this->socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 10, 'usec' => 10000));
        
        if (!($this->connected = socket_connect($this->socket, $host, $port))) {
            $error = socket_last_error();
            if ($error != SOCKET_EINPROGRESS && $error != SOCKET_EALREADY) {
                $this->errstr = "Error Connecting Socket: " . socket_strerror($error);
                socket_close($this->socket);
                return NULL;
            }
        }
    }

    public function getSocket() {
        return $this->socket;
    }

    public function getConnected() {
        return $this->connected;
    }

}
