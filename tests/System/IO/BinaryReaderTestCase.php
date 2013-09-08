<?php

use \System\IO\BinaryReader as BinaryReader;
use \System\IO\MemoryStream as MemoryStream;
use \System\IO\FileMode as FileMode;
use \System\IO\FileAccess as FileAccess;

/**
 * @group io
*/
class BinaryReaderTestCase extends PHPUnit_Framework_TestCase {

    public function setUp() 
    {
        
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function Construct_ThrowsExceptionWhenStreamNotSupportReading() 
    {

        #Arrange:
        $stream = new MemoryStream(array());
        $stream->dispose();

        #Act:
        new BinaryReader($stream);
   }
}
