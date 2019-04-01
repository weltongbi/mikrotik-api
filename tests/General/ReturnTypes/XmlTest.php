<?php

namespace General\ReturnTypes;

use MikrotikAPI\MikrotikAPI;
use PHPUnit\Framework\TestCase;

/**
 * Description of XmlTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class XmlTest extends TestCase
{
    protected static $id;
    protected $preserveGlobalState = false;
    protected $runTestInSeparateProcess = true;

    public function testReturnXml()
    {
        $mk = new MikrotikAPI();
        $mk->setDebug($_ENV['MikrotikDebug']);
        $mk->setResultType('xml');
        $mk->setSimple($_ENV['MikrotikHost'], $_ENV['MikrotikUser'], $_ENV['MikrotikPassword']);
        $mk->initialize();

        $return = $mk->user->getAll();

        //convert xml in object
        $xml_data = simplexml_load_string($return);

        $this->assertIsObject($xml_data);
        $this->assertObjectHasAttribute('item0', $xml_data);
    }
}
