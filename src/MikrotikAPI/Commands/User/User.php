<?php

namespace MikrotikAPI\Commands\User;

use MikrotikAPI\Talker\Talker;

/**
 * Description of User.
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
 * @property AAA     $aaa     Description
 * @property Active  $active  Description
 * @property Profile $profile Description
 * @property Secret  $secret  Description
 */
class User
{
    use \MikrotikAPI\Entity\Methods;

    /**
     * @var type array
     */
    private $talker;
    private $class = [
        //'aaa' => 'MikrotikAPI\Commands\PPP\AAA',
        //'active' => 'MikrotikAPI\Commands\PPP\Active',
        //'profile' => 'MikrotikAPI\Commands\PPP\Profile',
        //'secret' => 'MikrotikAPI\Commands\PPP\Secret',
    ];

    public function __construct(Talker $talker)
    {
        $this->setAllowedMethods(['add', 'set', 'remove', 'enable', 'disable']);
        $this->setMainCommand('/user');

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
