<?php

namespace General\ReturnTypes;

use MikrotikAPI\MikrotikAPI;
use PHPUnit\Framework\TestCase;

/**
 * Description of JsonTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class JsonTest extends TestCase
{
    protected static $id;
    protected $preserveGlobalState = false;
    protected $runTestInSeparateProcess = true;

    public function testReturnJson()
    {
        $mk = new MikrotikAPI();
        $mk->setDebug($_ENV['MikrotikDebug']);
        $mk->setResultType('json');
        $mk->setSimple($_ENV['MikrotikHost'], $_ENV['MikrotikUser'], $_ENV['MikrotikPassword']);
        $mk->initialize();

        $return = $mk->user->getAll();
        $this->assertJson($return);
    }
}
