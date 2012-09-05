<?php
//require_once 'PHPUnit/Framework.php';


require_once dirname(__FILE__) . '/../../system/Convert.php';

class ConvertFixture extends PHPUnit_Framework_TestCase {

    /* TODO: Implement Method ChangeType */
    /*public function testWhenTryChangeTypeNullShouldThrowException() {
        $this->setExpectedException("ArgumentNullException");
        Convert::ChangeType(null, null);
    }*/


    public function test_FromBase64String_ThrowsExceptionWhenParameterIsNull() {
        $this->setExpectedException("ArgumentNullException");
        Convert::FromBase64String(null);
    }

    public function test_FromBase64String_ThrowsExceptionWhenLengthOfStringIsNotZeroOrAMultipleOfFour() {
        $this->setExpectedException("FormatException");
        Convert::FromBase64String("aGVsbG8gd29ybGQKk");
    }

    public function test_FromBase64String_ShouldReturnArrayOfBytes() {
        //$bytes = Convert::FromBase64String("aGVsbG8gd29ybGQK");
        echo ("b" % 256);
    }


}
?>
