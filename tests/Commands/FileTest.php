<?php

namespace Commands;

/**
 * Description of FileTest.
 *
 * @author Welton Castro weltongbi@gmail.com <welton.dev>
 * @copyright Copyright (c) 2019
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @category Tests
 */
class FileTest extends TestCase
{
    protected static $id;
    protected static $_isset;

    public function testExportFile()
    {
        self::$mk->build->addCommand('/user/export');
        self::$mk->build->setAttribute('file', 'test');
        self::$mk->send();
        sleep(1);
        $this->assertTrue(self::$mk->do->isDone());
    }

    public function testGetFile()
    {
        $files = self::$mk->file->getAll();

        $filter = array_filter($files, function ($file) {
            return $file['name'] == 'test.rsc';
        });

        foreach ($filter as $value) {
            self::$id = $value['.id'];
        }
        $this->assertIsString(self::$id);
    }

    /**
     * @afterClass
     */
    public static function tearRemoveFile()
    {
        self::assertTrue(self::$mk->file->remove(self::$id));
    }
}
