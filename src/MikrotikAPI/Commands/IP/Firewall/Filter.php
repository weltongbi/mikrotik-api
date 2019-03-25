<?php

namespace MikrotikAPI\Commands\IP\Firewall;

use MikrotikAPI\Talker\Talker;

/**
 * Description of Filter.
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
class Filter
{
    use \MikrotikAPI\Entity\Methods;

    /**
     * @var type array
     */
    private $talker;

    public function __construct(Talker $talker)
    {
        $this->setAllowedMethods('*');
        $this->setMainCommand('/ip/firewall/filter');

        $this->talker = $talker;
    }
}
