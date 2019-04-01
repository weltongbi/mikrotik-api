<?php

namespace General\ReturnTypes;

use MikrotikAPI\MikrotikAPI;
use PHPUnit\Framework\TestCase;

/**
 * Description of ArrayTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class ArrayTest extends TestCase
{
    protected static $id;
    protected $preserveGlobalState = false;
    protected $runTestInSeparateProcess = true;

    public function testReturnArray()
    {
        $mk = new MikrotikAPI();
        $mk->setDebug($_ENV['MikrotikDebug']);
        $mk->setResultType('array');
        $mk->setSimple($_ENV['MikrotikHost'], $_ENV['MikrotikUser'], $_ENV['MikrotikPassword']);
        $mk->initialize();

        $return = $mk->user->getAll();
        $this->assertIsArray($return);
    }
}
