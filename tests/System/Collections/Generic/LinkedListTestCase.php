<?php

use \System\Collections\Generic\LinkedList as LinkedList;

class LinkedListTestCase extends PHPUnit_Framework_TestCase 
{
    public function testCanAddFirstToLinkedList() {
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");

        $this->assertEquals(1, $linked->count());
        $this->assertEquals("Alexandre", $linked->first()->value());

        $linked->addFirst("Barbieri");
        $this->assertEquals(2, $linked->count());
        $this->assertEquals("Barbieri", $linked->first()->value());
        $this->assertEquals("Alexandre", $linked->first()->next()->value());
        $this->assertEquals(null, $linked->last()->next());
        $this->assertEquals(null, $linked->first()->previous());
    }

    public function testCanAddLastToLinkedList() {
        $linked = new LinkedList();
        $linked->addLast("Alexandre");

        $this->assertEquals(1, $linked->count());
        $this->assertEquals("Alexandre", $linked->last()->value());
        $linked->addLast("Barbieri");
        $this->assertEquals(2, $linked->count());
        $this->assertEquals("Barbieri", $linked->last()->value());
        $this->assertEquals("Alexandre", $linked->last()->previous()->value());
        $this->assertEquals("Alexandre", $linked->first()->value());
        $this->assertEquals("Barbieri", $linked->first()->next()->value());
        $this->assertEquals(null, $linked->last()->next());
        $this->assertEquals(null, $linked->first()->previous());
    }

    public function testCanAddFirstAndLastElement() {
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");
        $linked->addLast("Barbieri");

        $this->assertEquals(2, $linked->count());
        $this->assertEquals("Alexandre", $linked->first()->value());
        $this->assertEquals("Barbieri", $linked->last()->value());
        $this->assertEquals("Alexandre", $linked->last()->previous()->value());
        $this->assertEquals("Barbieri", $linked->first()->next()->value());
        $this->assertEquals(null, $linked->last()->next());
        $this->assertEquals(null, $linked->first()->previous());
    }

    public function testCanAddBeforeElement() {
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");
        $linked->addBefore(0, "Programmer");

        $this->assertEquals(2, $linked->count());
        $this->assertEquals("Programmer", $linked->first()->value());

        $linked->addBefore(1, "Php");
        $this->assertEquals("Php", $linked->first()->next()->value());
    }

    public function testCanAddAfterElement() {
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");
        $linked->addAfter(0, "Programmer");

        $this->assertEquals(2, $linked->count());
        // $this->assertEquals("Programmer", $linked->get(1)->value());

        $linked->addAfter(5, "Php");
        $this->assertEquals("Php", $linked->last()->value());
        $this->assertEquals("Programmer", $linked->last()->previous()->value());
    }

    public function testCanFindFirstElement() {
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");
        $linked->addAfter(0, "Programmer");
        $linked->addAfter(5, "Php");
        $linked->addLast("Programmer");

        $find = $linked->find("Programmer");
        $this->assertEquals("Programmer", $find->value());
        $this->assertEquals("Alexandre", $find->previous()->value());
    }

    public function testCanFindLastElement() {
        $linked = new LinkedList();
        $linked->addFirst("Alexandre");
        $linked->addAfter(0, "Programmer");
        $linked->addAfter(5, "Php");
        $linked->addLast("Programmer");

        $find = $linked->findLast("Programmer");
        $this->assertEquals("Programmer", $find->value());
        $this->assertEquals("Php", $find->previous()->value());
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
