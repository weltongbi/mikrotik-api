<?php

namespace Commands\IP\Firewall;

use Commands\TestCase;

/**
 * Description of AddressListTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class AddressListTest extends TestCase
{
    protected static $id;

    public function testAddAddressList()
    {
        $return = self::$mk->ip->firewall->address_list->add(['list' => 'test', 'address' => '10.10.10.2']);

        $this->assertIsArray($return);
        $this->assertArrayHasKey(0, $return);
        $this->assertArrayHasKey('ret', $return[0]);
        if (isset($return[0]['ret'])) {
            self::$id = $return[0]['ret'];
        }
    }

    public function testSetAddressList()
    {
        $this->assertTrue(self::$mk->ip->firewall->address_list->set(['address' => '10.10.10.5'], self::$id));
    }

    public function testDisableAddressList()
    {
        $this->assertTrue(self::$mk->ip->firewall->address_list->disable(self::$id));
    }

    public function testEnableAddressList()
    {
        $this->assertTrue(self::$mk->ip->firewall->address_list->enable(self::$id));
    }

    /**
     * @afterClass
     */
    public static function tearRemoveAddressList()
    {
        self::assertTrue(self::$mk->ip->firewall->address_list->remove(self::$id));
    }
}
