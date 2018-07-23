<?php

namespace MikrotikAPI\Entity;

/**
 * Description of Auth
 *
 * @author nunenuh
 */
trait Auth {

    /**
     *
     * @var string
     */
    private $host;

    /**
     * Default 8728
     * @var int 
     */
    private $port = 8728;

    /**
     *
     * @var string
     */
    private $username;

    /**
     * Default blank
     * @var string 
     */
    private $password = "";

    /**
     * Default 5
     * @var int
     */
    private $attempts = 5;

    /**
     * Default 2
     * @var int
     */
    private $delay = 2;

    /**
     * Default 2
     * @var int
     */
    private $timeout = 2;

    /**
     * 
     * @param string $host ip ou dominio do mikrotik
     * @param int $port porta da api
     * @param string $username usuário
     * @param string $password senha
     * @param int $attempts
     * @param int $delay
     * @param int $timeout
     */
    public function set($host, $port, $username, $password, $attempts, $delay, $timeout) {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->attempts = $attempts;
        $this->delay = $delay;
        $this->timeout = $timeout;
    }

    /**
     * Seta as configurações principais assumindo o restante como default;
     * @param string $host ip ou domínio do mikrotik
     * @param string $username usuário
     * @param string $password senha
     */
    public function setSimple($host, $username, $password) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    public function getHost() {
        return $this->host;
    }

    public function getPort() {
        return $this->port;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getAttempts() {
        return $this->attempts;
    }

    public function getDelay() {
        return $this->delay;
    }

    public function getTimeout() {
        return $this->timeout;
    }

    /**
     * 
     * @param string $host
     */
    public function setHost($host) {
        $this->host = $host;
    }

    /**
     * 
     * @param int $port
     */
    public function setPort($port) {
        $this->port = $port;
    }

    /**
     * 
     * @param string $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * 
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * 
     * @param int $attempts
     */
    public function setAttempts($attempts) {
        $this->attempts = $attempts;
    }

    /**
     * 
     * @param int $delay
     */
    public function setDelay($delay) {
        $this->delay = $delay;
    }

    /**
     * 
     * @param int $timeout
     */
    public function setTimeout($timeout) {
        $this->timeout = $timeout;
    }
}
