<?php

require_once dirname(__FILE__) . '/../../../src/Autoloader.php';

use \System\IO\BinaryReader as BinaryReader;
use \System\IO\FileStream as FileStream;
use \System\IO\FileMode as FileMode;
use \System\IO\FileAccess as FileAccess;

class BinaryReaderFixture extends PHPUnit_Framework_TestCase {

    private $info;

    public function setUp() {
        $this->info = unpack("H*","dotnetonphp");
    }

    public function test_Construct_ThrowsExceptionWhenStreamNotSupportReading() {

        #Arrange:
        $this->setExpectedException("\System\ArgumentException");
        $stream = new FileStream(dirname(__FILE__) . "/../../resources/system.io.fileInfo.txt", FileMode::open(), FileAccess::write());

        #Act:
        new BinaryReader($stream);
   }

    public function test_Construct_ThrowsExceptionWhenStreamIsNull() {
        #Arrange:
        $this->setExpectedException("\System\ArgumentException");

        #Act:
        new BinaryReader(null);
    }
}
