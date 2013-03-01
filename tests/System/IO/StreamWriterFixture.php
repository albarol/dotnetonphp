<?php

require_once dirname(__FILE__) . '/../../../src/Autoloader.php';

use \System\IO\StreamWriter as StreamWriter;
use \System\IO\Stream as Stream;

class StreamWriterFixture extends PHPUnit_Framework_TestCase {

    protected $fileName;

    public function setUp() {
        $this->fileName = dirname(__FILE__) . "/../../resources/system.io.StreamWriter.txt";
    }

    public function test_BaseStream_CanGetBaseStream() {
        $writer = new StreamWriter($this->fileName);
        $this->assertTrue($writer->baseStream() instanceof Stream);
    }

    public function test_Close_CanCreateDocument() {
        $writer = new StreamWriter($this->fileName);
        $writer->close();
        $this->assertTrue(file_exists($this->fileName));
    }

    //public function test_Close_ThrowsExceptionWhenEncodingNotSupport(){}

    /*
    public function test_Encoding_CanGetEncoding() {
        $writer = new StreamWriter($this->FileName);
        $this->assertTrue($writer->encoding() instanceof Encoding);
    }*/

    public function test_Dispose_ClearResources() {
        $writer = new StreamWriter($this->fileName);
        $writer->dispose();
    }

    public function test_NewLine_CanChangeNewLineCharacters() {
        $writer = new StreamWriter($this->fileName);
        $writer->newLine("<br />");
        $this->assertEquals("<br />", $writer->newLine());
    }

    public function test_Write_ThrowsExceptionWhenObjectDisposed() {
        $this->setExpectedException("\\System\\ObjectDisposedException");
        $writer = new StreamWriter($this->fileName);
        $writer->dispose();
        $writer->write("dotnetonphp");
    }

    public function test_Write_CanWriteText() {
        $writer = new StreamWriter($this->fileName);
        $writer->write("dotnetonphp");
    }

    public function test_Write_CanWriteNumber() {
        $writer = new StreamWriter($this->fileName);
        $writer->write(123456);
    }

    public function test_WriteLine_CanWriteTextWithBreakLine() {
        $writer = new StreamWriter($this->fileName);
        $writer->writeLine("dotnetonphp");
    }
}
?>
