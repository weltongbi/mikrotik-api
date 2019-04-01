<?php

namespace General\ReturnMessage;

use Commands\TestCase;

/**
 * Description of DoneTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class DoneTest extends TestCase
{
    protected static $id;

    public function testDone()
    {
        self::$mk->ip->firewall->nat->add(['chain' => 'srcnat', 'action' => 'accept']);

        if (self::$mk->do->isDone()) {
            self::$id = self::$mk->do->getRet();
            $this->assertIsString(self::$id);
        }
    }

    /**
     * @afterClass
     */
    public static function tearRemoveDone()
    {
        self::assertTrue(self::$mk->ip->firewall->nat->remove(self::$id));
    }
}
