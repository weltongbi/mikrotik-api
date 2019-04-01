<?php

namespace Commands\PPP;

use Commands\TestCase;

/**
 * Description of SecretTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class SecretTest extends TestCase
{
    protected static $id;

    public function testAddSecret()
    {
        $return = self::$mk->ppp->secret->add([
            'name' => $this->randomName(),
            'service' => 'any',
            'caller-id' => '',
            'password' => '',
            'profile' => 'default',
        ]);

        $this->assertIsArray($return);
        $this->assertArrayHasKey(0, $return);
        $this->assertArrayHasKey('ret', $return[0]);
        if (isset($return[0]['ret'])) {
            self::$id = $return[0]['ret'];
        }
    }

    public function testSetSecret()
    {
        $this->assertTrue(self::$mk->ppp->secret->set(['routes' => 'rota1'], self::$id));
    }

    public function testDisableSecret()
    {
        $this->assertTrue(self::$mk->ppp->secret->disable(self::$id));
    }

    public function testEnableSecret()
    {
        $this->assertTrue(self::$mk->ppp->secret->enable(self::$id));
    }

    /**
     * @afterClass
     */
    public static function tearSetSecret()
    {
        self::assertTrue(self::$mk->ppp->secret->remove(self::$id));
    }
}
