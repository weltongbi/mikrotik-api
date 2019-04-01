<?php

namespace MikrotikAPI\Commands\PPP;

use MikrotikAPI\Talker\Talker;

/**
 * Description of Profile.
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
class Profile
{
    use \MikrotikAPI\Entity\Methods;

    /**
     * @var type array
     */
    private $talker;

    public function __construct(Talker $talker)
    {
        $this->setAllowedMethods(['add', 'set', 'remove']);
        $this->setMainCommand('/ppp/profile');

        $this->talker = $talker;
    }
}
