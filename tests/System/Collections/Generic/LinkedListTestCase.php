<?php

use \System\Collections\LinkedList as LinkedList;

class LinkedListTestCase extends PHPUnit_Framework_TestCase 
{
    public function testCanAddFirstToLinkedList() {
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");

        $this->assertEquals(1, $linked->count());
        $this->assertEquals("Alexandre", $linked->getFirst()->getValue());

        $linked->addFirst("Barbieri");
        $this->assertEquals(2, $linked->count());
        $this->assertEquals("Barbieri", $linked->getFirst()->getValue());
        $this->assertEquals("Alexandre", $linked->getFirst()->getNext()->getValue());
        $this->assertEquals(null, $linked->getLast()->getNext());
        $this->assertEquals(null, $linked->getFirst()->getPrevious());
    }

    public function testCanAddLastToLinkedList() {
        $linked = new LinkedList();
        $linked->addLast("Alexandre");

        $this->assertEquals(1, $linked->count());
        $this->assertEquals("Alexandre", $linked->getLast()->getValue());
        $linked->addLast("Barbieri");
        $this->assertEquals(2, $linked->count());
        $this->assertEquals("Barbieri", $linked->getLast()->getValue());
        $this->assertEquals("Alexandre", $linked->getLast()->getPrevious()->getValue());
        $this->assertEquals("Alexandre", $linked->getFirst()->getValue());
        $this->assertEquals("Barbieri", $linked->getFirst()->getNext()->getValue());
        $this->assertEquals(null, $linked->getLast()->getNext());
        $this->assertEquals(null, $linked->getFirst()->getPrevious());
    }

    public function testCanAddFirstAndLastElement() {
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");
        $linked->addLast("Barbieri");

        $this->assertEquals(2, $linked->count());
        $this->assertEquals("Alexandre", $linked->getFirst()->getValue());
        $this->assertEquals("Barbieri", $linked->getLast()->getValue());
        $this->assertEquals("Alexandre", $linked->getLast()->getPrevious()->getValue());
        $this->assertEquals("Barbieri", $linked->getFirst()->getNext()->getValue());
        $this->assertEquals(null, $linked->getLast()->getNext());
        $this->assertEquals(null, $linked->getFirst()->getPrevious());
    }

    public function testCanGetElement() {
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");
        $linked->addLast("Barbieri");
        $linked->addLast("Domingues");
        $linked->addLast("Oliveira");

        $this->assertEquals(4, $linked->count());
        $this->assertEquals("Barbieri", $linked->get(1)->getValue());
    }

    public function testCantGetElement() {
        $this->setExpectedException("OutOfRangeException");
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");
        $linked->addLast("Barbieri");
        $linked->addLast("Domingues");
        $linked->addLast("Oliveira");
        $this->assertEquals("Barbieri", $linked->get(15)->getValue());

    }

    public function testCanAddBeforeElement() {
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");
        $linked->addBefore(0, "Programmer");

        $this->assertEquals(2, $linked->count());
        $this->assertEquals("Programmer", $linked->getFirst()->getValue());

        $linked->addBefore(1, "Php");
        $this->assertEquals("Php", $linked->getFirst()->getNext()->getValue());
    }

    public function testCanAddAfterElement() {
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");
        $linked->addAfter(0, "Programmer");

        $this->assertEquals(2, $linked->count());
        $this->assertEquals("Programmer", $linked->get(1)->getValue());

        $linked->addAfter(5, "Php");
        $this->assertEquals("Php", $linked->getLast()->getValue());
        $this->assertEquals("Programmer", $linked->getLast()->getPrevious()->getValue());
    }

    public function testCanFindFirstElement() {
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");
        $linked->addAfter(0, "Programmer");
        $linked->addAfter(5, "Php");
        $linked->addLast("Programmer");

        $find = $linked->find("Programmer");
        $this->assertEquals("Programmer", $find->getValue());
        $this->assertEquals("Alexandre", $find->getPrevious()->getValue());
    }

    public function testCanFindLastElement() {
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");
        $linked->addAfter(0, "Programmer");
        $linked->addAfter(5, "Php");
        $linked->addLast("Programmer");

        $find = $linked->findLast("Programmer");
        $this->assertEquals("Programmer", $find->getValue());
        $this->assertEquals("Php", $find->getPrevious()->getValue());
    }

    public function testCantFindElement() {
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");
        $linked->addAfter(0, "Programmer");
        $linked->addAfter(5, "Php");
        $find = $linked->find("Domingues");
        $this->assertEquals(null, $find);
        $findLast = $linked->findLast("Domingues");
        $this->assertEquals(null, $findLast);
    }

    public function testCanRemoveElements() {
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");
        $linked->addAfter(0, "Programmer");
        $linked->addAfter(5, "Php");
        $linked->removeFirst("Programmer");
        $this->assertEquals(2, $linked->count());
        $linked->addAfter(0, "Programmer");
        $this->assertEquals(3, $linked->count());
        $linked->addLast("Programmer");
        $linked->removeLast("Programmer");
        $this->assertEquals(3, $linked->count());
    }

    public function testCanRemoveFirstElement() {
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");
        $this->assertEquals(1, $linked->count());
        $linked->remove(0);
        $this->assertEquals(0, $linked->count());
    }

    public function testCanClearElements(){
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");
        $linked->addFirst("Programmer");
        $linked->addFirst("Php");
        $linked->addFirst("Alexandre");
        $this->assertEquals(4, $linked->count());
        $linked->clear();
        $this->assertEquals(0, $linked->count());
    }
}

?>
