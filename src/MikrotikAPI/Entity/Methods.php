<?php

namespace MikrotikAPI\Entity;

use MikrotikAPI\Util\SentenceUtil;

/**
 * Description of trait Methods.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2018 - 2019
 *
 * @see welton.dev
 *
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Commands
 *
 * @method mixed add(array $param)             Add by array atributes [name=>value]
 * @method mixed set(array $param, string $id) Add by array atributes [name=>value] and id
 * @method mixed remove(string $id)            Remove by id
 * @method mixed enable(string $id)            Enable by id
 * @method mixed disable(string $id)           Disable by id
 * @method mixed reset_counters(string $id)    Reset Counters by id
 * @method mixed reset_counters_all()          Reset All Counters
 */
trait Methods
{
    /**
     * @var type array
     */
    private $_defaultMethods = ['*', 'add', 'set', 'remove', 'enable', 'disable', 'reset_counters', 'reset_counters_all'];
    /**
     * @var type string
     */
    private $main = '';
    /**
     * @var type array
     */
    private $allowedMethods = [];

    /**
     * setAllowedMethods Options:
     * ['add', 'set', 'remove', 'enable', 'disable', 'reset_counters', 'reset_counters_all']
     * For all
     * ['*'].
     *
     * @param array|string $methods (value)
     */
    private function setAllowedMethods($methods)
    {
        if (is_string($methods)) {
            if ($methods == '*') {
                return $this->allowedMethods = ['*'];
            }

            if (count(array_diff([$methods], $this->_defaultMethods)) == 0) {
                return $this->allowedMethods = [$methods];
            }
        } elseif (is_array($methods) && count(array_diff($methods, $this->_defaultMethods)) == 0) {
            $this->allowedMethods = $methods;
        } else {
            throw new \Exception('The method is not available!');
        }
    }

    /**
     * setMainCommand command.
     *
     * @param string $main command
     */
    private function setMainCommand(string $main)
    {
        $this->main = $main;
    }

    public function __call($name, $arg)
    {
        if (in_array('*', $this->allowedMethods)) {
        } elseif (!in_array($name, $this->allowedMethods)) {
            throw new \Exception('The method "'.$name.'()" does not exist or no allowed!');
        }

        switch ($name) {
            case 'add':
                return $this->M_add($arg[0]);
            case 'set':
                return $this->M_set($arg[0], $arg[1]);
            case 'remove':
                return $this->M_remove($arg[0]);
            case 'enable':
                return $this->M_enable($arg[0]);
            case 'disable':
                return $this->M_disable($arg[0]);
            case 'reset_counters':
                return $this->M_resetCounters($arg[0]);
            case 'reset_counters_all':
                return $this->M_resetAllCounters();
            default:
                throw new \Exception('The method "'.$name.'()" does not exist!');
        }
    }

    /**
     * get all value for main command.
     *
     * @return mixed
     */
    public function getAll()
    {
        $sentence = new SentenceUtil();
        $sentence->fromCommand($this->main.'/getall');
        $this->talker->send($sentence);

        return $this->talker->getResult();
    }

    /**
     * Print detail.
     *
     * @param string $id id
     *
     * @return mixed
     */
    public function detail($id)
    {
        $sentence = new SentenceUtil();
        $sentence->fromCommand($this->main.'/print');
        $sentence->where('.id', '=', $id);
        $this->talker->send($sentence);

        return $this->talker->getResult();
    }

    /**
     * Remove item by id.
     *
     * @param string $id
     *
     * @return mixed
     */
    private function M_remove($id)
    {
        $sentence = new SentenceUtil();
        $sentence->addCommand($this->main.'/remove');
        $sentence->numbers('=', $id);
        $this->talker->send($sentence);

        if ($this->talker->do->isDone()) {
            return true;
        }

        return $this->talker->getResult();
    }

    /**
     * Add by array.
     *
     * @param array $param (name ad value)
     *
     * @return mixed
     */
    private function M_add(array $param)
    {
        $sentence = new SentenceUtil();
        $sentence->addCommand($this->main.'/add');
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->talker->send($sentence);

        return $this->talker->getResult();
    }

    /**
     * Set by id.
     *
     * @param array  $param (name and value)
     * @param string $id
     *
     * @return bool|mixed
     */
    private function M_set(array $param, $id)
    {
        $sentence = new SentenceUtil();
        $sentence->addCommand($this->main.'/set');
        $sentence->numbers('=', $id);

        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->talker->send($sentence);

        if ($this->talker->do->isDone()) {
            return true;
        }

        return $this->talker->getResult();
    }

    /**
     * This method is used to enable by id.
     *
     * @param string $id
     *
     * @return bool|mixed
     */
    private function M_enable($id)
    {
        $sentence = new SentenceUtil();
        $sentence->addCommand($this->main.'/enable');
        $sentence->numbers('=', $id);
        $this->talker->send($sentence);

        if ($this->talker->do->isDone()) {
            return true;
        }

        return $this->talker->getResult();
    }

    /**
     * This method is used to disable by id.
     *
     * @param string $id
     *
     * @return bool|mixed
     */
    private function M_disable($id)
    {
        $sentence = new SentenceUtil();
        $sentence->addCommand($this->main.'/disable');
        $sentence->numbers('=', $id);
        $this->talker->send($sentence);

        if ($this->talker->do->isDone()) {
            return true;
        }

        return $this->talker->getResult();
    }

    /**
     * This method is used to reset counters by id.
     *
     * @param string $id
     *
     * @return bool|mixed
     */
    private function M_resetCounters($id)
    {
        $sentence = new SentenceUtil();
        $sentence->addCommand($this->main.'/reset-counters');
        $sentence->numbers('=', $id);
        $this->talker->send($sentence);

        if ($this->talker->do->isDone()) {
            return true;
        }

        return $this->talker->getResult();
    }

    /**
     * This method is used to reset all counters.
     *
     *
     * @return bool|mixed
     */
    private function M_resetAllCounters()
    {
        $sentence = new SentenceUtil();
        $sentence->fromCommand($this->main.'/reset-counters-all');
        $this->talker->send($sentence);

        if ($this->talker->do->isDone()) {
            return true;
        }

        return $this->talker->getResult();
    }
}
