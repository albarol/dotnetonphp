<?php

use \System\Object as Object;

/**
 * @group core
*/
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
        $this->assertEquals("System\Object", $object->toString());
    }
}
