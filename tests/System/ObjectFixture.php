<?php

//require_once 'PHPUnit/Framework.php';

require_once dirname(__FILE__) . '/../../system/Object.php';
require_once dirname(__FILE__) . '/../../system/String.php';

class ObjectFixture extends PHPUnit_Framework_TestCase {

    public function testWhenCreateObjectShouldBeNotNull() {
        $object = new Object();
        $this->assertNotNull($object);
    }

    public function testWhenCreateObjectShouldHaveHashCode() {
        $object = new Object();
        $this->assertGreaterThan(0, $object->getHashCode());
    }

    public function testWhenCompareTheSameObjectEqualsShouldBeTrue() {
        $object = new Object();
        $this->assertTrue($object->equals($object));
    }

    public function testWhenCompareTheDifferentObjectEqualsShouldBeFalse() {
        $object = new Object();
        $this->assertFalse($object->equals("string"));
    }

    public function testWhenCompareWithNullEqualsShouldBeFalse() {
        $object = new Object();
        $this->assertFalse($object->equals(null));
    }

    public function testWhenGetToStringShouldBeNameOfClass() {
        $object = new Object();
        $this->assertEquals("Object", $object->toString());
    }
}
?>
