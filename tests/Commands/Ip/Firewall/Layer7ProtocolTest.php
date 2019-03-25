<?php

namespace Commands\IP\Firewall;

use Commands\TestCase;

/**
 * Description of Layer7ProtocolTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class Layer7ProtocolTest extends TestCase
{
    protected static $id;

    public function testAddLayer7Protocol()
    {
        $return = self::$mk->ip->firewall->layer7_protocol->add(['name' => 'test', 'regexp' => '^(.*test.welton.dev.*)$']);

        $this->assertIsArray($return);
        $this->assertArrayHasKey(0, $return);
        $this->assertArrayHasKey('ret', $return[0]);
        if (isset($return[0]['ret'])) {
            self::$id = $return[0]['ret'];
        }
    }

    public function testSetLayer7Protocol()
    {
        $this->assertTrue(self::$mk->ip->firewall->layer7_protocol->set(['regexp' => '^(.*test2.welton.dev.*)$'], self::$id));
    }

    /**
     * @afterClass
     */
    public static function tearRemoveLayer7Protocol()
    {
        self::assertTrue(self::$mk->ip->firewall->layer7_protocol->remove(self::$id));
    }
}
