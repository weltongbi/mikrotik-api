<?php

namespace MikrotikAPI\Commands\PPP;

use MikrotikAPI\Talker\Talker;

/**
 * Description of Active.
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
class Active
{
    use \MikrotikAPI\Entity\Methods;

    /**
     * @var type array
     */
    private $talker;

    public function __construct(Talker $talker)
    {
        $this->setAllowedMethods(['remove']);
        $this->setMainCommand('/ppp/active');

        $this->talker = $talker;
    }
}
