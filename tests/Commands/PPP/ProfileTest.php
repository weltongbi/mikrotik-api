<?php

namespace Commands\PPP;

use Commands\TestCase;

/**
 * Description of ProfileTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class ProfileTest extends TestCase
{
    protected static $id;

    public function testAddProfile()
    {
        $return = self::$mk->ppp->profile->add([
            'name' => $this->randomName(),
            'use-mpls' => 'default',
            'use-compression' => 'default',
            'use-encryption' => 'default',
            'only-one' => 'default',
        ]);

        $this->assertIsArray($return);
        $this->assertArrayHasKey(0, $return);
        $this->assertArrayHasKey('ret', $return[0]);
        if (isset($return[0]['ret'])) {
            self::$id = $return[0]['ret'];
        }
    }

    public function testSetProfile()
    {
        $this->assertTrue(self::$mk->ppp->profile->set(['dns-server' => '8.8.8.8'], self::$id));
    }

    /**
     * @afterClass
     */
    public static function tearSetProfile()
    {
        self::assertTrue(self::$mk->ppp->profile->remove(self::$id));
    }
}
