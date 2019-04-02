<?php

namespace  MikrotikAPI\Commands;

use MikrotikAPI\Talker\Talker;

/**
 * Description of File.
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
class File
{
    use \MikrotikAPI\Entity\Methods;

    /**
     * @var type array
     */
    private $talker;

    public function __construct(Talker $talker)
    {
        $this->setAllowedMethods(['set', 'remove']);
        $this->setMainCommand('/file');

        $this->talker = $talker;
    }
}
