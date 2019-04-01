<?php

namespace General\ReturnMessage;

use Commands\TestCase;

/**
 * Description of TrapTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class TrapTest extends TestCase
{
    protected static $id;

    public function testTrap()
    {
        self::$mk->ip->firewall->nat->add(['chains' => 'srcnat', 'action' => 'accept']);

        if (self::$mk->do->isTrap()) {
            $message = self::$mk->do->getTrapMessage();
            $this->assertIsString($message);
            $this->assertStringContainsString('unknown parameter', $message);
        }
    }
}
