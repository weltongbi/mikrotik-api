<?php

/*
 * Este codigo foi desenvolvidor por welton castro.
 * Email: weltongbi@gmail.com.
 */

namespace MikrotikAPI\Entity;

use MikrotikAPI\Util\SentenceUtil;

/**
 * Description of methods
 *
 * @author welton
 */
trait Methods {
    /*
     * get all
     */
    /**
     * get all value for main comand
     * @return Mixed
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand($this->main . "/getall");
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     * Print detail
     * @param string $id id 
     * @return mixed
     */
    public function detail($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand($this->main . "/print");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     * Remove item by id
     * @param string $id
     * @return mixed
     */
    private function M_remove($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand($this->main . "/remove");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     * Add by array
     * @param array $param (name ad value)
     * @return mixed
     */
    private function M_add(array $param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand($this->main . "/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     * Set by id
     * @param array $param (name and value)
     * @param string $id
     * @return mixed
     */
    private function M_set(array $param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand($this->main . "/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     * This method is used to enable by id
     * @param string $id 
     * @return mixed
     * 
     */
    private function M_enable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand($this->main . "/enable");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

    /**
     * This method is used to disable by id
     * @param string $id 
     * @return mixed
     */
    private function M_disable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand($this->main . "/disable");
        $sentence->where(".id", "=", $id);
        $this->talker->send($sentence);
        return $this->talker->getResult();
    }

}
