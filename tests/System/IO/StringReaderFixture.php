<?php

require_once dirname(__FILE__) . '/../../../src/Autoloader.php';

use \System\IO\StringReader as StringReader;

class StringReaderFixture extends PHPUnit_Framework_TestCase {

    protected $reader;

    public function setUp() {
        $this->reader = new StringReader("DotNetOnPhp\r\nFramework\r\nPhp");
    }

    public function test_Construct_ThrowsExceptionWhenArgumentIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        new StringReader(null);
    }

    public function test_Construct_CanConstruct() {
        $stringReader = new StringReader("DotNetOnPhp");
        $this->assertEquals("DotNetOnPhp", $stringReader->readToEnd());
    }

    public function test_ReadLine_ThrowsExceptionWhenStringReaderIsClosed() {
        $this->setExpectedException("\\System\\ObjectDisposedException");
        $this->reader->close();
        $this->reader->readLine();
    }

    public function test_ReadLine_CanReadLine() {
        $this->assertEquals("DotNetOnPhp", $this->reader->readLine());
    }

    public function test_ReadToEnd_ThrowsExceptionWhenStringReaderIsClosed() {
        $this->setExpectedException("\\System\\ObjectDisposedException");
        $this->reader->close();
        $this->reader->readToEnd();
    }

    public function test_ReadToEnd_CanReadToEndFromString() {
        $expected = "DotNetOnPhp\r\nFramework\r\nPhp";
        $this->assertEquals($expected, $this->reader->readToEnd());
    }

    public function test_Read_ThrowsExceptionWhenStringReaderIsClosed() {
        $this->setExpectedException("\\System\\ObjectDisposedException");
        $this->reader->close();
        $this->reader->read(0, 1);
    }

    public function test_Read_CanReadBuffer() {
        $array = $this->reader->read(0, 2);
        $this->assertEquals(2, sizeof($array));
    }

    public function test_Read_WhenIndexIsNullShouldReadLine() {
        $this->assertEquals('D', $this->reader->read());
    }

    public function test_ReadBlock_CanReadBuffer() {
        $array = $this->reader->readBlock( 0, 2);
        $this->assertEquals(2, sizeof($array));
        $this->assertEquals("Do", implode($array, ""));
    }

     public function test_Peek_ThrowExceptionWhenFileIsClosed() {
        $this->setExpectedException("\\System\\ObjectDisposedException");
        $this->reader->close();
        $this->reader->peek();
    }

    public function test_Peek_CanPeekInformation() {
        $this->assertEquals("D", $this->reader->peek());
        $this->assertEquals("D", $this->reader->peek());
    }
}
