<?php

/*
 * Este codigo foi desenvolvidor por welton castro.
 * Email: weltongbi@gmail.com.
 */

namespace MikrotikAPI\Core;

use MikrotikAPI\Util\Debug;

/**
 * Description of Socket.
 *
 * @author welton
 */
class Socket
{
    private $socket;
    private $connected = false;

    public function __construct($host, $port)
    {
        if (!extension_loaded('sockets')) {
            die('The sockets extension is not loaded.');
        }

        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        socket_set_option($this->socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 10, 'usec' => 0));

        if (!($this->connected = socket_connect($this->socket, $host, $port))) {
            $error = socket_last_error();
            if ($error != SOCKET_EINPROGRESS && $error != SOCKET_EALREADY) {
                Debug::error('Error Connecting Socket: '.socket_strerror($error));
                socket_close($this->socket);
                exit();
            }
        }
    }

    public function getSocket()
    {
        return $this->socket;
    }

    public function getConnected()
    {
        return $this->connected;
    }
}
