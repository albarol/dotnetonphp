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

    private function generateFileWithBreakLine()
    {
        $filename = $this->generateName();
        $fd = fopen($filename, 'w');
        fwrite($fd, str_repeat('dotnetonphp'.PHP_EOL, 10));
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
     * @expectedException \System\IO\IOException
    */
    public function Peek_ThrowExceptionWhenFileIsClosed() {

        # Arrange:
        $sr = new StreamReader($this->generateFile());
        $sr->close();

        # Act:
        # Assert:
        $sr->peek();
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
    */
    public function Peek_CanPeekManyTimes() {

        # Arrange:
        $sr = new StreamReader($this->generateFile());

        # Act:
        # Assert:
        $this->assertEquals("d", $sr->peek());
        $this->assertEquals("d", $sr->peek());
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
        $sr = new StreamReader($this->generateFile());

        # Act:
        $content = $sr->read();

        # Assert:
        $this->assertEquals('o', $sr->read());
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function ReadBlock_ThrowsExceptionWhenIndexIsNegative() {

        # Arrange:
        $sr = new StreamReader($this->generateFile());

        # Act:
        # Assert:
        $sr->readBlock(-1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function ReadBlock_ThrowsExceptionWhenCountIsNegative() {

        # Arrange:
        $sr = new StreamReader($this->generateFile());

        # Act:
        # Assert:
        $sr->readBlock(0, -1);
    }

    /**
     * @test
     * @expectedException \System\ObjectDisposedException
    */
    public function ReadBlock_ThrowsExceptionWhenReaderIsClosed() {

        # Arrange:
        $sr = new StreamReader($this->generateFile());
        $sr->close();

        # Act:
        # Assert:
        $sr->readBlock(0, -1);
    }

    /**
     * @test
    */
    public function ReadBlock_ReadInfoFromStream() {

        # Arrange:
        $sr = new StreamReader($this->generateFile());

        # Act:
        $block = $sr->readBlock(0, 6);

        # Assert:
        $this->assertEquals('dotnet', implode($block));
    }


    /**
     * @test
     * @expectedException \System\IO\IOException
    */
    public function ReadLine_ThrowsExceptionWhenFileIsClosed() {

        # Arrange:
        $sr = new StreamReader($this->generateFile());
        $sr->close();

        # Act:
        $sr->readLine();
    }

    /**
     * @test
    */
    public function ReadLine_CanReadLineFromFile() {

        # Arrange:
        $sr = new StreamReader($this->generateFileWithBreakLine());

        # Act:
        $content = $sr->readLine();

        # Assert:
        $this->assertEquals('dotnetonphp', $content);
    }

    /**
     * @test
     * @expectedException \System\IO\IOException
    */
    public function ReadToEnd_ThrowsExceptionWhenFileIsClosed() {

        # Arrange:
        $sr = new StreamReader($this->generateFile());
        $sr->close();

        # Act:
        $sr->readToEnd();
    }

    /**
     * @test
    */
    public function ReadToEnd_CanReadToEndFromFile() {

        # Arrange:
        $content = str_repeat('dotnetonphp'.PHP_EOL, 10);
        $sr = new StreamReader($this->generateFileWithBreakLine());

        # Act:
        $result = $sr->readToEnd();

        # Assert:
        $this->assertEquals($content, $result);
    }
}
