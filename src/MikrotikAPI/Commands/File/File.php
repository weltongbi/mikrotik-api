<?php

namespace MikrotikAPI\Commands\File;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Talker\Talker;

/**
 * Description of Mapi_File
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class File {

    use \MikrotikAPI\Entity\Methods;

    /**
     * @access private
     * @var type array
     */
    private $talker;
    private $main = "";

    function __construct(Talker $talker) {
        $this->talker = $talker;
    }

}
