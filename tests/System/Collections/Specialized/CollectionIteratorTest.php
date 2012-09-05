<?php

require_once 'PHPUnit/Framework.php';

require_once dirname(__FILE__) . '/../../../../system/collections/specialized/CollectionIterator.php';
require_once dirname(__FILE__) . '/../../../../system/collections/Collection.php';

class CollectionIteratorTest extends PHPUnit_Framework_TestCase {

    public function testCanGetFirstElement() {
        $collection = new CollectionBase();
        $collection->add(10);
        $collection->add(20);
        $collection->add(30);

        $iterator = new CollectionIterator($collection);

        $this->assertEquals(10, $iterator->first());
        $iterator->next();
        $this->assertEquals(10, $iterator->first());
    }

    public function testCanGetNextElement() {
        $collection = new CollectionBase();
        $collection->add(10);
        $collection->add(20);
        $collection->add(30);

        $iterator = new CollectionIterator($collection);

        $this->assertEquals(10, $iterator->first());
        $this->assertEquals(20, $iterator->next());
        $this->assertEquals(30, $iterator->next());
    }

    public function testCantGetNextElement() {
        $this->setExpectedException("Exception");


        $collection = new CollectionBase();
        $collection->add(10);
        $collection->add(20);
        $collection->add(30);

        $iterator = new CollectionIterator($collection);

        $this->assertEquals(10, $iterator->first());
        $this->assertEquals(20, $iterator->next());
        $this->assertEquals(30, $iterator->next());
        $this->assertEquals(40, $iterator->next());
    }

    public function testGetCurrentElement() {
        $collection = new CollectionBase();
        $collection->add(10);
        $collection->add(20);
        $collection->add(30);

        $iterator = new CollectionIterator($collection);

        $this->assertEquals(10, $iterator->first());
        $this->assertEquals(10, $iterator->current());
        $this->assertEquals(20, $iterator->next());
        $this->assertEquals(20, $iterator->current());
        $this->assertEquals(30, $iterator->next());
        $this->assertEquals(30, $iterator->current());
    }

    public function testCanNavigateInObjects() {
        $value = 10;
        $collection = new CollectionBase();
        $collection->add(10);
        $collection->add(20);
        $collection->add(30);
        $collection->add(40);
        $collection->add(50);
        $collection->add(60);

        $iterator = new CollectionIterator($collection);

        while($iterator->hasNext()) {
            $value = $value + 10;
            $this->assertEquals($value, $iterator->next());
        }
    }
}

?>
