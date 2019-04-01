<?php

namespace MikrotikAPI\Commands\System;

use MikrotikAPI\Talker\Talker;

/**
 * Description of System.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2018 - 2019
 *
 * @see welton.dev
 *
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category	 Commands
 *
 * @property Scheduler $scheduler Description
 */
class System
{
    /**
     * @var type array
     */
    private $talker;
    private $class = [
        'scheduler' => 'MikrotikAPI\Commands\System\Scheduler',
    ];

    public function __construct(Talker $talker)
    {
        $this->talker = $talker;
    }

    public function __get($name)
    {
        if ($this->class[$name]) {
            $class = $this->class[$name];

            return new $class($this->talker);
        }
        throw new \Exception('The method not exist');
    }
}
