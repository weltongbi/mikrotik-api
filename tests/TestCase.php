<?php

namespace Commands;

use MikrotikAPI\MikrotikAPI;
use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * Description of RawTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 *
 * @property MikrotikAPI $mk Instance MikrotikAPI\MikrotikAPI
 */
class TestCase extends BaseTestCase
{
    protected static $mk;

    /**
     * @beforeClass
     */
    public static function setAddAddressList()
    {
        if (empty(self::$mk)) {
            self::$mk = new MikrotikAPI();
            self::$mk->setDebug($_ENV['MikrotikDebug']);
            self::$mk->setSimple($_ENV['MikrotikHost'], $_ENV['MikrotikUser'], $_ENV['MikrotikPassword']);
            self::$mk->initialize();
        }
    }

    public static function randomName()
    {
        $tamanho = mt_rand(5, 9);
        $all_str = 'abcdefghijlkmnopqrstuvxyzwABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $nome = '';
        for ($i = 0; $i <= $tamanho; ++$i) {
            $nome .= $all_str[mt_rand(0, 61)];
        }

        return $nome;
    }
}
