<?php

require_once dirname(__FILE__) . '/../../../system/io/StreamReader.php';

use \System\IO\StreamReader as StreamReader;
use \System\IO\TextReader as TextReader;

class StreamReaderFixture extends PHPUnit_Framework_TestCase {

    protected $fileName;

    public function setUp() {
        $this->fileName = dirname(__FILE__) . "/../../resources/system.io.StreamReader.txt";
    }

    public function test_Constructor_ThrowsExceptionWhenArgumentIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        new StreamReader(null);
    }

    public function test_Constructor_ThrowsExceptionWhenArgumentIsInvalid() {
        $this->setExpectedException("\\System\\ArgumentException");
        new StreamReader("");
    }

    public function test_Constructor_ThrowsExceptionWhenFileNotFound() {
        $this->setExpectedException("\\System\\IO\\IOException");
        new StreamReader("c:\file_was_not_found.txt");
    }

    public function test_Constructor_CanCreateObject() {
        $reader = new StreamReader($this->fileName);
        $this->assertTrue($reader instanceof StreamReader);
    }

    public function test_Close_CanCloseStreamReader() {
        $reader = new StreamReader($this->fileName);
        $reader->close();
    }

    public function test_EndOfStream_ThrowsExceptionWhenObjectWasDisposed() {
        $this->setExpectedException("\\System\\ObjectDisposedException");
        $reader = new StreamReader($this->fileName);
        $reader->dispose();
        $reader->endOfStream();
    }

    public function test_EndOfStream_ShouldReturnFalseAfterReadFistLine() {
        $reader = new StreamReader($this->fileName);
        $reader->readLine();
        $this->assertFalse($reader->endOfStream());
    }

    public function test_EndOfStream_ShouldReturnTrueAfterReadToEnd(){
        $reader = new StreamReader($this->fileName);
        $reader->readToEnd();
        $this->assertTrue($reader->endOfStream());
    }

    public function test_ReadLine_ThrowsExceptionWhenFileIsClosed() {
        $this->setExpectedException("\\System\\IO\\IOException");
        $reader = new StreamReader($this->fileName);
        $reader->close();
        $reader->readLine();
    }

    public function test_ReadLine_CanReadLineFromFile() {
        $reader = new StreamReader($this->fileName);
        $this->assertEquals("dot", $reader->readLine());
    }

    public function test_ReadToEnd_ThrowsExceptionWhenFileIsClosed() {
        $this->setExpectedException("\\System\\IO\\IOException");
        $reader = new StreamReader($this->fileName);
        $reader->close();
        $reader->readToEnd();
    }

    public function test_ReadToEnd_CanReadToEndFromFile() {
        $reader = new StreamReader($this->fileName);
        $expected = "dot\r\nnet\r\non\r\nphp";
        $this->assertEquals($expected, $reader->readToEnd());
    }

    public function test_Read_ThrowsExceptionWhenStreamIsClosed() {
        $this->setExpectedException("\\System\\IO\\IOException");
        $reader = new StreamReader($this->fileName);
        $reader->close();
        $array = array();
        $reader->read($array, 0, 1);
    }

    public function test_Read_CanReadBuffer() {
        $reader = new StreamReader($this->fileName);
        $array = array();
        $reader->read($array, 0, 4);
        $this->assertEquals(4, sizeof($array));
    }

    public function test_Read_CanReadNextCharacter() {
        $reader = new StreamReader($this->fileName);
        $this->assertEquals("d", $reader->read());
    }

    public function test_ReadBlock_CanReadBuffer() {
        $reader = new StreamReader($this->fileName);
        $array = array();
        $reader->read($array, 0, 5);
        $this->assertEquals(5, sizeof($array));
    }

    public function test_Peek_ThrowExceptionWhenFileIsClosed() {
        $this->setExpectedException("\\System\\IO\\IOException");
        $reader = new StreamReader($this->fileName);
        $reader->close();
        $reader->peek();
    }
    
    public function test_Peek_CanPeekInformation() {
        $reader = new StreamReader($this->fileName);
        $this->assertEquals("d", $reader->peek());
        $this->assertEquals("d", $reader->peek());
    }

    public function test_Synchronized_CanGetTextReader() {
        $reader = new StreamReader($this->fileName);
        $textReader = TextReader::synchronized($reader);
        $this->assertTrue($textReader instanceof TextReader);
    }
}
?>
