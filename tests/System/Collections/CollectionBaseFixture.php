<?php

require_once(dirname(__FILE__) . '/../../../system/Char.php');
require_once(dirname(__FILE__) . '/../../../system/collections/CollectionBase.php');

use \System\Collections\CollectionBase as CollectionBase;
use \System\Char as Char;

class CharCollection extends CollectionBase {

    public function __construct() {
        parent::__construct("\\System\\Char");
    }
}

class CollectionBaseFixture extends PHPUnit_Framework_TestCase {

    public function test_Add_CantAddWhenTypeIsDifferent() {
        $col = new CharCollection();
        $col->add("a");
        $this->assertEquals(0, $col->count());
    }

    public function test_Add_CanAddWhenTypeIsEqual() {
        $col = new CharCollection();
        $col->add(new Char('1'));
        $this->assertEquals(1, $col->count());
    }

}
?>