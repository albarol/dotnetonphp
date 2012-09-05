<?php

require_once 'PHPUnit/Framework.php';
require_once dirname(__FILE__) . '/../../system/Int32.php';

use System\Int32;


class Int32Fixture extends PHPUnit_Framework_TestCase {


    public function testCantConstructInt32BecauseValueIsGreaterThanMaxValue() {
        $this->setExpectedException("OverflowException");
        $int = new Int32(2147483648);
    }

    public function testCantConstructInt32BecauseValueIsLessThanMinValue() {
        $this->setExpectedException("OverflowException");
        $int = new Int32(-2147483648);
    }

    public function testCantConstructInt32BecauseValueIsNotNumeric() {
        $this->setExpectedException("ArgumentException");
        $int = new Int32('a');
    }

    public function testCanCompareInt() {
        $int = new Int32(25);
        $this->assertEquals(-1, $int->compareTo(26));
        $this->assertEquals(0, $int->compareTo(25));
        $this->assertEquals(1, $int->compareTo(24));
    }

    public function testVerifyIfObjectIsEqual() {
        $int = new Int32(25);
        $this->assertEquals(true, $int->equals(25));
        $this->assertEquals(false, $int->equals(26));
        $this->assertEquals(true, $int->equals(new Int32(25)));
        $this->assertEquals(false, $int->equals(new Int32(26)));
    }

    public function testCanGetTypeCode() {
        $int = new Int32(10);
        $this->assertEquals(\System\TypeCode::int32(), $int->getTypeCode());
    }


}

?>
