<?php

namespace Commands\PPP;

use Commands\TestCase;

/**
 * Description of AAATest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class AAATest extends TestCase
{
    protected static $id;

    public function testSetAAA()
    {
        $this->assertTrue(self::$mk->ppp->aaa->set(['use-radius' => 'no']));
    }

    /**
     * @afterClass
     */
    public static function tearSetAAA()
    {
        self::assertTrue(self::$mk->ppp->aaa->set(['use-radius' => 'no']));
    }
}
