<?php

require_once dirname(__FILE__) . '/../../../system/text/Encoding.php';

use System\Text\Encoding as Encoding;


class EncodingFixture extends PHPUnit_Framework_TestCase {

    public function test_CloneObject_CanCloneInstanceOfEncoding() {
        $this->markTestIncomplete();
    }

    public function test_GetEncoding_ThrowsExceptionWhenCodePageIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        Encoding::getEncoding(-1);
    }

    public function test_GetEncoding_ThrowsExceptionWhenCodePageIsGreaterThan65535() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        Encoding::getEncoding(65536);
    }

    public function test_GetEncoding_ThrowsExceptionWhenCodePageIsNotSupported() {
        $this->setExpectedException("\\System\\NotSupportedException");
        Encoding::getEncoding(1);
    }

    public function test_GetEncoding_CanGetEncodingByCodePage() {
        $encoding = Encoding::getEncoding(1141);
        $this->assertEquals("IBM01141", $encoding->name());
    }

    public function test_GetEncoding_ThrowsExceptionWhenNameIsInvalid() {
        $this->setExpectedException("\\System\\ArgumentException");
        Encoding::getEncoding("ErrorEncoding");
    }

    public function test_GetEncoding_CanGetEncodingByName() {
        $encoding = Encoding::getEncoding("IBM01141");
        $this->assertEquals(1141, $encoding->codePage());
    }

    public function test_GetEncodings_CanShowListOfEncodings() {
        $encodings = Encoding::getEncodings();
        $this->assertEquals(140, sizeof($encodings));
    }
}
?>