<?php

use \System\Convert as Convert;

/**
 * @group core
*/
class ConvertTestCase extends PHPUnit_Framework_TestCase {

    /**
     * @test
     * @expectedException \System\ArgumentNullException
     */
    public function FromBase64String_ThrowsExceptionWhenParameterIsNull() {

        # Arrange:
        # Act:
        Convert::fromBase64String(null);
    }

    /**
     * @test
     * @expectedException \System\FormatException
     */
    public function FromBase64String_ThrowsExceptionWhenHasInvalidFormat() {
        
        # Arrange:
        $s = "aGVsbG8gd29ybGQKk!@#AF";

        # Act:
        Convert::fromBase64String($s);
    }

    /**
     * @test
     */
    public function FromBase64String_ShouldGetStringFromBase64() {
        
        # Arrange:
        $s = "aGVsbG8gd29ybGQ";
        $h_binary = '01101000';

        # Act:
        $result = Convert::fromBase64String($s);

        # Assert:
        $this->assertEquals($h_binary, $result[0]);
    }
}
