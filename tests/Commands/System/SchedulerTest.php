<?php

namespace Commands\System;

use Commands\TestCase;

/**
 * Description of SchedulerTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class SchedulerTest extends TestCase
{
    protected static $id;

    public function testAddScheduler()
    {
        $return = self::$mk->system->scheduler->add(['name' => $this->randomName()]);

        $this->assertIsArray($return);
        $this->assertArrayHasKey(0, $return);
        $this->assertArrayHasKey('ret', $return[0]);
        if (isset($return[0]['ret'])) {
            self::$id = $return[0]['ret'];
        }
    }

    public function testSetScheduler()
    {
        $this->assertTrue(self::$mk->system->scheduler->set(['name' => $this->randomName()], self::$id));
    }

    public function testDisableScheduler()
    {
        $this->assertTrue(self::$mk->system->scheduler->disable(self::$id));
    }

    public function testEnableScheduler()
    {
        $this->assertTrue(self::$mk->system->scheduler->enable(self::$id));
    }

    /**
     * @afterClass
     */
    public static function tearRemoveScheduler()
    {
        self::assertTrue(self::$mk->system->scheduler->remove(self::$id));
    }
}
