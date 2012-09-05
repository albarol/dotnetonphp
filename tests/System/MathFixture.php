<?php

//require_once 'PHPUnit/Framework.php';

require_once dirname(__FILE__) . '/../../system/Math.php';

class MathFixture extends PHPUnit_Framework_TestCase {

    public function testWhenGetPIShouldBeEqualFromPhp() {

        $pi = 3.1415926535898;
        $this->assertEquals($pi, Math::PI);
    }

    public function testCanSignValue() {
        $this->assertEquals(1, Math::sign(10));
        $this->assertEquals(0, Math::sign(0));
        $this->assertEquals(-1, Math::sign(-10));
    }
}

?>
