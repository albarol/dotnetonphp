<?php

require_once dirname(__FILE__) . '/../../../src/Autoloader.php';

use \System\Text\StringBuilder as StringBuilder;
use \System\IO\StringWriter as StringWriter;

class StringWriterFixture extends PHPUnit_Framework_TestCase {

    protected $builder;

    protected function setUp() {
        $this->builder = new StringBuilder();
        $this->builder->append("dotnetonphp");
    }

    public function test_Close_CanCloseStringWriter() {
        $writer = new StringWriter($this->builder);
        $writer->close();
    }

    //public function test_Close_ThrowsExceptionWhenEncodingNotSupport(){}

    /*
    public function test_Encoding_CanGetEncoding() {
        $writer = new StreamWriter($this->FileName);
        $this->assertTrue($writer->encoding() instanceof Encoding);
    }*/

    public function test_Dispose_ClearResources() {
        $writer = new StringWriter($this->builder);
        $writer->dispose();
    }

    public function test_GetStringBuilder_GetStringWhenConstructWithoutString() {
        $writer = new StringWriter();
        $this->assertTrue($writer->getStringBuilder() instanceof StringBuilder);
    }

    public function test_GetStringBuilder_CanGetStringBuilder() {
        $writer = new StringWriter($this->builder);
        $this->assertTrue($writer->getStringBuilder() instanceof StringBuilder);
    }

    public function test_NewLine_CanChangeNewLineCharacters() {
        $writer = new StringWriter($this->builder);
        $writer->newLine("<br />");
        $this->assertEquals("<br />", $writer->newLine());
    }

    public function test_Write_ThrowsExceptionWhenObjectDisposed() {
        $this->setExpectedException("\\System\\ObjectDisposedException");
        $writer = new StringWriter($this->builder);
        $writer->dispose();
        $writer->write("dotnetonphp");
    }

    public function test_Write_CanWriteText() {
        $writer = new StringWriter($this->builder);
        $writer->write("dotnetonphp");
    }

    public function test_Write_CanWriteNumber() {
        $writer = new StringWriter($this->builder);
        $writer->write(123456);
    }

    public function test_WriteLine_CanWriteTextWithBreakLine() {
        $writer = new StringWriter($this->builder);
        $writer->writeLine("dotnetonphp");
    }
}
?>
