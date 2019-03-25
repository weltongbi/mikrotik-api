<?php

namespace Commands\IP\Firewall;

use Commands\TestCase;

/**
 * Description of ServicePortTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class ServicePortTest extends TestCase
{
    protected static $id;

    public function testGetAllServicePort()
    {
        $return = self::$mk->ip->firewall->service_port->getAll();

        $this->assertIsArray($return);
        $this->assertArrayHasKey(0, $return);

        if (isset($return[0]['.id']) && is_array($return) && count($return) >= 1) {
            self::$id = $return[0]['.id'];
        }
    }

    public function testSetServicePort()
    {
        $this->assertTrue(self::$mk->ip->firewall->service_port->set(['ports' => '45000'], self::$id));
    }

    public function testDisableServicePort()
    {
        $this->assertTrue(self::$mk->ip->firewall->service_port->disable(self::$id));
    }

    public function testEnableServicePort()
    {
        $this->assertTrue(self::$mk->ip->firewall->service_port->enable(self::$id));
    }
}
