<?php

use \System\Convert as Convert;

/**
 * @group core
*/
class ConvertTestCase extends PHPUnit_Framework_TestCase {

    /* TODO: Implement Method ChangeType */
    /*public function testWhenTryChangeTypeNullShouldThrowException() {
        $this->setExpectedException("ArgumentNullException");
        Convert::ChangeType(null, null);
    }*/


    public function test_FromBase64String_ThrowsExceptionWhenParameterIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        Convert::FromBase64String(null);
    }

    public function test_FromBase64String_ThrowsExceptionWhenLengthOfStringIsNotZeroOrAMultipleOfFour() {
        $this->setExpectedException("\\System\\FormatException");
        Convert::FromBase64String("aGVsbG8gd29ybGQKk");
    }

    public function test_FromBase64String_ShouldReturnArrayOfBytes() {
        //$bytes = Convert::FromBase64String("aGVsbG8gd29ybGQK");
        echo ("b" % 256);
    }


}
