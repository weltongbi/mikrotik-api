<?php

namespace Commands\IP\Firewall;

use Commands\TestCase;

/**
 * Description of MangleTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class MangleTest extends TestCase
{
    protected static $id;

    public function testAddMangle()
    {
        $return = self::$mk->ip->firewall->mangle->add(['chain' => 'prerouting', 'action' => 'accept']);

        $this->assertIsArray($return);
        $this->assertArrayHasKey(0, $return);
        $this->assertArrayHasKey('ret', $return[0]);
        if (isset($return[0]['ret'])) {
            self::$id = $return[0]['ret'];
        }
    }

    public function testSetMangle()
    {
        $this->assertTrue(self::$mk->ip->firewall->mangle->set(['src-address-list' => 'test'], self::$id));
    }

    public function testDisableMangle()
    {
        $this->assertTrue(self::$mk->ip->firewall->mangle->disable(self::$id));
    }

    public function testEnableMangle()
    {
        $this->assertTrue(self::$mk->ip->firewall->mangle->enable(self::$id));
    }

    /**
     * @afterClass
     */
    public static function tearRemoveMangle()
    {
        self::assertTrue(self::$mk->ip->firewall->mangle->remove(self::$id));
    }
}
