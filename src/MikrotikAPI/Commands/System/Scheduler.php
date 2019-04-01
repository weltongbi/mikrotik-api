<?php

namespace MikrotikAPI\Commands\System;

use MikrotikAPI\Talker\Talker;

/**
 * Description of Scheduler.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2018 - 2019
 *
 * @see welton.dev
 *
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Commands
 */
class Scheduler
{
    use \MikrotikAPI\Entity\Methods;

    /**
     * @var type array
     */
    private $talker;

    public function __construct(Talker $talker)
    {
        $this->setAllowedMethods(['add', 'set', 'remove', 'enable', 'disable']);
        $this->setMainCommand('/system/scheduler');

        $this->talker = $talker;
    }
}
