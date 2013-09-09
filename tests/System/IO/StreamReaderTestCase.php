<?php

use \System\IO\StreamReader as StreamReader;
use \System\IO\TextReader as TextReader;

class StreamReaderTestCase extends PHPUnit_Framework_TestCase
{
    private function generateName()
    {
        return '/tmp/'.md5(rand(1, 20).rand(23, 55).rand(70, 98)).'.str';
    }

    private function generateFile()
    {
        $filename = $this->generateName();
        $fd = fopen($filename, 'w');
        fwrite($fd, 'dotnetonphp');
        fclose($fd);
        return $filename;
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function Constructor_ThrowsExceptionWhenArgumentIsNull()
    {
        # Arrange:
        # Act:
        new StreamReader(null);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function Constructor_ThrowsExceptionWhenArgumentIsInvalid()
    {
        # Arrange:
        # Act:
        new StreamReader("");
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function Constructor_ThrowsExceptionWhenFileNotFound()
    {
        # Arrange:
        $name = $this->generateName();

        # Act:
        new StreamReader($name);
    }

    /**
     * @test
    */
    public function Constructor_CanCreateObject()
    {
        # Arrange:
        $name = $this->generateFile();

        # Act:
        $reader = new StreamReader($name);

        # Assert:
        $this->assertNotNull($reader);
    }

    /**
     * @test
     * @expectedException \System\ObjectDisposedException
    */
    public function EndOfStream_ThrowsExceptionWhenObjectWasDisposed() {

        # Arrange:
        $file = $this->generateFile();
        $reader = new StreamReader($file);
        $reader->close();

        # Act:
        $result = $reader->endOfStream();
    }

    /**
     * @test
    */
    public function EndOfStream_ShouldReturnFalseAfterPeek() {

        # Arrange:
        $file = $this->generateFile();
        $reader = new StreamReader($file);
        $reader->peek();

        # Act:
        $result = $reader->endOfStream();

        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
    */
    public function EndOfStream_ShouldReturnTrueAfterReadToEnd(){

        # Arrange:
        $file = $this->generateFile();
        $reader = new StreamReader($file);

        # Act:
        # Assert:
        $reader->readToEnd();
        $this->assertTrue($reader->endOfStream());
    }

    /**
     * @test
    */
    public function Peek_ReturnEmptyWhenFileEndOfStream() {
    
        # Arrange:
        $file = $this->generateFile();
        $sr = new StreamReader($file);
        $sr->readToEnd();
    
        # Act:
        $content = $sr->peek();

        # Arrange:
        $this->assertEquals("", $content);
    }

    /**
     * @test
    */
    public function Peek_ReadNextCharacter() {
    
        # Arrange:
        $file = $this->generateFile();
        $sr = new StreamReader($file);
    
        # Act:
        $content = $sr->peek();
    
        # Assert:
        $this->assertEquals('d', $content);
    }

    /**
     * @test
     * @expectedException \System\IO\IOException
    */
    public function Read_ThrowsExceptionWhenStreamIsClosed() {

        # Arrange:
        $file = $this->generateFile();
        $sr = new StreamReader($file);
        $sr->close();

        # Act:
        $sr->read();
    }

    /**
     * @test
    */
    public function Read_GetNextByteFromStream() {

        # Arrange:
        $file = $this->generateFile();
        $sr = new StreamReader($file);

        # Act:
        $content = $sr->read();

        # Assert:
        $this->assertEquals('o', $sr->read());
    }

    // /**
    //  * @test
    // */
    // public function Read_CanReadNextCharacter() {
    //     $reader = new StreamReader($this->fileName);
    //     $this->assertEquals("d", $reader->read());
    // }

    // /**
    //  * @test
    //  * @expectedException \System\IO\IOException
    // */
    // public function ReadLine_ThrowsExceptionWhenFileIsClosed() {

    //     # Arrange:
    //     $file = $this->generateFile();
    //     $reader = new StreamReader($file);
    //     $reader->close();

    //     # Act:
    //     $reader->readLine();
    // }

    // /**
    //  * @test
    // */
    // public function ReadLine_CanReadLineFromFile() {
    //     $reader = new StreamReader($this->fileName);
    //     $this->assertEquals("dot", $reader->readLine());
    // }

    // /**
    //  * @test
    // */
    // public function ReadToEnd_ThrowsExceptionWhenFileIsClosed() {
    //     $this->setExpectedException("\\System\\IO\\IOException");
    //     $reader = new StreamReader($this->fileName);
    //     $reader->close();
    //     $reader->readToEnd();
    // }

    // /**
    //  * @test
    // */
    // public function ReadToEnd_CanReadToEndFromFile() {
    //     $reader = new StreamReader($this->fileName);
    //     $expected = "dot\r\nnet\r\non\r\nphp";
    //     $this->assertEquals($expected, $reader->readToEnd());
    // }

    

    // /**
    //  * @test
    // */
    // public function ReadBlock_CanReadBuffer() {
    //     $reader = new StreamReader($this->fileName);
    //     $array = $reader->read(0, 5);
    //     $this->assertEquals(5, sizeof($array));
    // }

    // /**
    //  * @test
    // */
    // public function Peek_ThrowExceptionWhenFileIsClosed() {
    //     $this->setExpectedException("\\System\\IO\\IOException");
    //     $reader = new StreamReader($this->fileName);
    //     $reader->close();
    //     $reader->peek();
    // }

    // /**
    //  * @test
    // */
    // public function Peek_CanPeekInformation() {
    //     $reader = new StreamReader($this->fileName);
    //     $this->assertEquals("d", $reader->peek());
    //     $this->assertEquals("d", $reader->peek());
    // }

    // /**
    //  * @test
    // */
    // public function Synchronized_CanGetTextReader() {
    //     $reader = new StreamReader($this->fileName);
    //     $textReader = TextReader::synchronized($reader);
    //     $this->assertTrue($textReader instanceof TextReader);
    // }
}
