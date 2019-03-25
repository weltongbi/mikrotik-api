<?php

namespace Commands\IP\Firewall;

use Commands\TestCase;

/**
 * Description of FilterTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class FilterTest extends TestCase
{
    protected static $id;

    public function testAddFilter()
    {
        $return = self::$mk->ip->firewall->filter->add(['chain' => 'forward', 'action' => 'accept']);

        $this->assertIsArray($return);
        $this->assertArrayHasKey(0, $return);
        $this->assertArrayHasKey('ret', $return[0]);
        if (isset($return[0]['ret'])) {
            self::$id = $return[0]['ret'];
        }
    }

    public function testSetFilter()
    {
        $this->assertTrue(self::$mk->ip->firewall->filter->set(['protocol' => 'tcp'], self::$id));
    }

    public function testDisableFilter()
    {
        $this->assertTrue(self::$mk->ip->firewall->filter->disable(self::$id));
    }

    public function testEnableFilter()
    {
        $this->assertTrue(self::$mk->ip->firewall->filter->enable(self::$id));
    }

    /**
     * @afterClass
     */
    public static function tearRemoveFilter()
    {
        self::assertTrue(self::$mk->ip->firewall->filter->remove(self::$id));
    }
}
