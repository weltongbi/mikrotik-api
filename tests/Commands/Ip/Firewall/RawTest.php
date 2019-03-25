<?php

namespace Commands\IP\Firewall;

use Commands\TestCase;

/**
 * Description of RawTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class RawTest extends TestCase
{
    protected static $id;

    public function testAddRaw()
    {
        $return = self::$mk->ip->firewall->raw->add(['chain' => 'prerouting', 'action' => 'accept']);

        $this->assertIsArray($return);
        $this->assertArrayHasKey(0, $return);
        $this->assertArrayHasKey('ret', $return[0]);
        if (isset($return[0]['ret'])) {
            self::$id = $return[0]['ret'];
        }
    }

    public function testSetRaw()
    {
        $this->assertTrue(self::$mk->ip->firewall->raw->set(['protocol' => 'tcp'], self::$id));
    }

    public function testDisableRaw()
    {
        $this->assertTrue(self::$mk->ip->firewall->raw->disable(self::$id));
    }

    public function testEnableRaw()
    {
        $this->assertTrue(self::$mk->ip->firewall->raw->enable(self::$id));
    }

    /**
     * @afterClass
     */
    public static function tearRemoveRaw()
    {
        self::assertTrue(self::$mk->ip->firewall->raw->remove(self::$id));
    }
}
