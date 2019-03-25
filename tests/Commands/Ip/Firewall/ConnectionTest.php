<?php

namespace Commands\IP\Firewall;

use Commands\TestCase;

/**
 * Description of ConnectionTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class ConnectionTest extends TestCase
{
    protected static $id;

    public function testGetAllConnection()
    {
        $return = self::$mk->ip->firewall->connection->getAll();

        $this->assertIsArray($return);
        $this->assertArrayHasKey(0, $return);

        if (isset($return[0]['.id']) && is_array($return) && count($return) >= 1) {
            self::$id = $return[0]['.id'];
        }
    }

    /**
     * @afterClass
     */
    public static function tearRemoveConnection()
    {
        self::assertTrue(self::$mk->ip->firewall->connection->remove(self::$id));
    }
}
