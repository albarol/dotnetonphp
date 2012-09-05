<?php

require_once dirname(__FILE__) . '/../../../system/text/StringBuilder.php';

class StringBuilderFixture extends PHPUnit_Framework_TestCase {

    public function testWhenAppendTextShouldHaveText() {
        $builder = new StringBuilder();
        $builder->append("Php");
        $this->assertEquals($builder->toString(), "Php");
    }

    public function testThrowsWhenAppendTextGreaterThanCapacity() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $builder = new StringBuilder(2);
        $builder->append("Php");
    }

    public function testThrowsExceptionWhenAppendNull() {
        $this->setExpectedException("ArgumentNullException");
        $builder = new StringBuilder();
        $builder->append(null);
    }

    public function testWhenAppendWithCountShouldHavePartOfText() {
        $builder = new StringBuilder();
        $builder->append("PhpOnDotNet", 6, "3");
        $this->assertEquals($builder->toString(), "otN");
    }

    public function testWhenAppendWithStartIndexShouldBeginAfterTheStartOfText() {
        $builder = new StringBuilder();
        $builder->append("PhpOnDotNet", 6);
        $this->assertEquals($builder->toString(), "otNet");
    }

    public function testCantAppendSubstringWhenStartIndexIsGreatherThanValue() {
        $this->setExpectedException("ArgumentOutOfRangeException");

        $builder = new StringBuilder();
        $builder->append("PhpOnDotNet", 9, 3);
    }

    public function testCantAppendSubstringWhenStartIndexIsLessThanZero() {
        $this->setExpectedException("ArgumentOutOfRangeException");

        $builder = new StringBuilder();
        $builder->append("PhpOnDotNet", -1, -1);
    }

    public function testWhenAppendWithOneFormatShouldReplaceFirstElement() {
        $builder = new StringBuilder();
        $builder->appendFormat("Php {0}", array("On"));
        $this->assertEquals($builder->toString(), "Php On");
    }

    public function testWhenAppendWithManyFormatsShouldReplaceElements() {
        $builder = new StringBuilder();
        $builder->appendFormat("{0}{1}{2}{3}", array("dot", "net", "on", "php"));
        $this->assertEquals($builder->toString(), "dotnetonphp");
    }

    public function testThrowsExceptionWhenTextIsNull() {
        $this->setExpectedException("ArgumentNullException");
        $builder = new StringBuilder();
        $builder->appendFormat(null, array("null"));
    }

    public function testThrowsExceptionWhenArgumentIsNull() {
        $this->setExpectedException("ArgumentNullException");
        $builder = new StringBuilder();
        $builder->appendFormat("{0}", null);
    }

    public function testThrowsExceptionWhenAppendFormatExceedMaxCapacity() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $builder = new StringBuilder(2);
        $builder->appendFormat("Php {0} ", array("On"));
    }

    public function testWhenAppendLineShouldHaveBreaklineCharacters() {
        $builder = new StringBuilder();
        $builder->appendLine("PhpOnDotNet");
        $this->assertEquals($builder->toString(), "PhpOnDotNet\r\n");
    }

    public function testWhenAppendLineWithEmptyValueShouldHaveBreaklineCharacters() {
        $builder = new StringBuilder();
        $builder->appendLine();
        $this->assertEquals($builder->toString(), "\r\n");
    }

    public function testThrowsExceptionWhenAppendLineExceedMaxCapacity() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $builder = new StringBuilder(2);
        $builder->appendLine();
        $builder->appendLine();
    }

    public function testThrowsExceptionWhenCopyBecauseDestionationIsNull() {
        $this->setExpectedException("ArgumentNullException");
        $builder = new StringBuilder();
        $builder->append("PhpOnDotNet");
        $builder->copyTo(0, $char, 0, 10);
    }

    public function testThrowsExceptionCopyBecauseSourceIndexIsLessThanZero() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $char = array("a");
        $builder = new StringBuilder();
        $builder->append("PhpOnDotNet");
        $builder->copyTo(-1, $char, 0, 1);
    }

    public function testThrowsExceptionCopyBecauseDestinationIndexIsLessThanZero() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $char = array("a");
        $builder = new StringBuilder();
        $builder->append("PhpOnDotNet");
        $builder->copyTo(1, $char, -1, 5);
    }

    public function testThrowsExceptionWhenCopyBecauseSourceIndexGreaterThanStringLength() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $char = array("a");
        $builder = new StringBuilder();
        $builder->append("Php");
        $builder->copyTo(5, $char, 0, 2);
    }

    public function testThrowsExceptionWhenCopyBecauseSourceIndexPlusCountGreaterThanStringLength() {
        $this->setExpectedException("ArgumentException");
        $char = array("a");
        $builder = new StringBuilder();
        $builder->append("Php");
        $builder->copyTo(0, $char, 0, 8);
    }

    public function testThrowsExceptionWhenCopyBecauseDestinationIndexGreaterThanArraySize() {
        $this->setExpectedException("ArgumentException");
        $char = array("a");
        $builder = new StringBuilder();
        $builder->append("Php");
        $builder->copyTo(0, $char, 2, 2);
    }

    public function testWhenCopyShouldBeReplaceOldValue() {
        $char = array("a", "b", "c", "d", "e", "f", "g", "h");
        $builder = new StringBuilder();
        $builder->append("Php");
        $this->assertEquals("a", $char[0]);
        $builder->copyTo(0, $char, 0, 3);
        $this->assertEquals("P", $char[0]);
    }

    public function testThrowsExceptionWhenEnsureCapacityBecauseCapacityIsLessThanZero() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $builder = new StringBuilder(10);
        $builder->ensureCapacity(-1);
    }

    public function testThrowsExceptionEnsureCapacityBecauseCapacityIsGreaterThanMaxCapacity() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $builder = new StringBuilder(10);
        $builder->ensureCapacity(20);
    }

    public function testWhenEnsureCapacityThenCapacityShouldBeModified() {
        $builder = new StringBuilder();
        $builder->ensureCapacity(20);
        $this->assertEquals(20, $builder->capacity());
    }

    public function testWhenInsertTheTextShouldBeModified() {
        $builder = new StringBuilder();
        $builder->append("dotNet");
        $builder->insert(0, "On");
        $builder->insert(0, "Php");
        $this->assertEquals("PhpOndotNet", $builder->toString());
    }

    public function testWhenTrucateTheTextShouldBeClear() {
        $builder = new StringBuilder();
        $builder->append("dotNet");
        $builder->length(2);
        $this->assertEquals("do", $builder->toString());
    }

    public function testThrowsExceptionWhenTruncateStringBecauseSizeIsLessThanZero() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $builder = new StringBuilder();
        $builder->append("dotNet");
        $builder->length(-1);
    }

    public function testThrowsExceptionWhenTruncateStringBecauseSizeIsGreatherThanLength() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $builder = new StringBuilder();
        $builder->append("dotNet");
        $builder->length(50);
    }

    public function testThrowsExceptionWhenRemoveStringsBecauseStartIndexIsLessThanZero() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $builder = new StringBuilder();
        $builder->append("dotNet");
        $builder->remove(-1, 3);
    }

    public function testThrowsExceptionWhenRemoveStringsBecauseLengthIsLessThanZero() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $builder = new StringBuilder();
        $builder->append("dotNet");
        $builder->remove(0, -1);
    }

    public function testThrowsExceptionWhenRemoveStringsBecauseLengthIsGreaterThanLength() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $builder = new StringBuilder();
        $builder->append("dotNet");
        $builder->remove(0, 10);
    }

    public function testWhenRemoveStringTheResultShouldBePartOfTheText() {
        $builder = new StringBuilder();
        $builder->append("dotNet");
        $oldBuilder = $builder->remove(0, 3);
        $this->assertEquals("dotNet", $oldBuilder->toString());
    }

    public function testWhenReplaceTheOldValueShouldBeEqualNewValue() {
        $builder = new StringBuilder();
        $builder->append("dotNet");
        $builder->replace("N", "n");
        $this->assertEquals("dotnet", $builder->toString());
    }

    public function testCantReplaceStringsBecauseStartIndexLessThanZero() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $builder = new StringBuilder();
        $builder->append("dotNet");
        $oldBuilder = $builder->replace("N", "n", -1, 10);
        $this->assertEquals("dotnet", $builder->toString());
    }

    public function testCantReplaceStringsBecauseCountLessThanZero() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $builder = new StringBuilder();
        $builder->append("dotNet");
        $oldBuilder = $builder->replace("N", "n", 0, -1);
        $this->assertEquals("dotnet", $builder->toString());
    }

    public function testCantReplaceStringsBecauseStartIndexPlusCountIsGreaterThanLength() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $builder = new StringBuilder();
        $builder->append("dotNet");
        $oldBuilder = $builder->replace("N", "n", 5, 10);
        $this->assertEquals("dotnet", $builder->toString());
    }

    public function testCanReplaceStringsInRange() {
        $builder = new StringBuilder();
        $builder->append("dotnetonphp");
        $oldBuilder = $builder->replace("n", "+", 4, 5);
        $this->assertEquals("dotneto+php", $builder->toString());
    }

    public function testCantGetPositionOfString() {
        $this->setExpectedException("IndexOutOfRangeException");
        $builder = new StringBuilder();
        $builder->append("dotnetonphp");
        $builder->get(30);
    }

    public function testCanGetPositionOfString() {
        $builder = new StringBuilder();
        $builder->append("dotnetonphp");
        $this->assertEquals("t", $builder->get(2));
    }

}
?>
