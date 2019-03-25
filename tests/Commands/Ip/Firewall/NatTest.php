<?php

namespace Commands\IP\Firewall;

use Commands\TestCase;

/**
 * Description of NatTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class NatTest extends TestCase
{
    protected static $id;

    public function testAddNat()
    {
        $return = self::$mk->ip->firewall->nat->add(['chain' => 'srcnat', 'action' => 'accept']);

        $this->assertIsArray($return);
        $this->assertArrayHasKey(0, $return);
        $this->assertArrayHasKey('ret', $return[0]);
        if (isset($return[0]['ret'])) {
            self::$id = $return[0]['ret'];
        }
    }

    public function testSetNat()
    {
        $this->assertTrue(self::$mk->ip->firewall->nat->set(['src-address-list' => 'test'], self::$id));
    }

    public function testDisableNat()
    {
        $this->assertTrue(self::$mk->ip->firewall->nat->disable(self::$id));
    }

    public function testEnableNat()
    {
        $this->assertTrue(self::$mk->ip->firewall->nat->enable(self::$id));
    }

    public function testResetCountersNat()
    {
        $this->assertTrue(self::$mk->ip->firewall->nat->reset_counters(self::$id));
    }

    public function testResetCountersAllNat()
    {
        $this->assertTrue(self::$mk->ip->firewall->nat->reset_counters_all());
    }

    /**
     * @afterClass
     */
    public static function tearRemoveNat()
    {
        self::assertTrue(self::$mk->ip->firewall->nat->remove(self::$id));
    }
}
