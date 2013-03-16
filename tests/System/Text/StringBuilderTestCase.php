<?php

use \System\Text\StringBuilder as StringBuilder;

class StringBuilderFixture extends PHPUnit_Framework_TestCase 
{
    
    /**
     * @test
    */
    public function Construct_ShouldSetMaxCapacity() {
        
        # Arrange:
        $max_capacity = 10;
    
        # Act:
        $sBuilder = new StringBuilder($max_capacity);
    
        # Assert:
        $this->assertEquals(10, $sBuilder->maxCapacity());
    }


    /**
     * @test
    */
    public function Append_ShouldAppendText() 
    {
        # Arrange:
        $builder = new StringBuilder();
        
        # Act:
        $builder->append("Php");

        # Assert:
        $this->assertEquals($builder->toString(), "Php");
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Append_ThrowsExceptionWhenTextIsGreatherThanCapacity() 
    {
        # Arrange:
        $builder = new StringBuilder(2);
        
        # Act:
        $builder->append("Php");
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function Append_ThrowsExceptionWhenAppendNull() 
    {
        # Arrange:
        $builder = new StringBuilder();
        
        # Act:
        $builder->append(null);
    }

    /**
     * @test
    */
    public function Append_ShouldAppendPartOfTextDelimitedByIndex() 
    {
        # Arrange:
        $text = "dotnetonphp";
        $builder = new StringBuilder();
        
        # Act:
        $builder->append($text, 6);

        # Assert:
        $this->assertEquals("onphp", $builder->toString());
    }

    /**
     * @test
    */
    public function Append_ShouldAppendParteOfTextDelimitedByIndexAndCount() 
    {
        # Arrange:
        $text = "dotnetonphp";
        $builder = new StringBuilder();
        
        # Act:
        $builder->append($text, 6, 2);

        # Assert:
        $this->assertEquals("on", $builder->toString());
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Append_ThrowsExceptionWhenStartIndexIsGreaterThanText() 
    {
        # Arrange:
        $text = "dotnetonphp";
        $builder = new StringBuilder();
        
        # Act:
        $builder->append($text, 20);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Append_ThrowsExceptionWhenStartIndexIsNegative() 
    {
        # Arrange:
        $text = "dotnetonphp";
        $builder = new StringBuilder();
        
        # Act:
        $builder->append($text, -1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Append_ThrowsExceptionWhenCountIsNegative() 
    {
        # Arrange:
        $text = "dotnetonphp";
        $builder = new StringBuilder();
        
        # Act:
        $builder->append($text, 0, -1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function AppendFormat_ThrowsExceptionWhenFormatIsNull() 
    {
        # Arrange:
        $builder = new StringBuilder();
        
        # Act:
        $builder->appendFormat(null, "");
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function AppendFormat_ThrowsExceptionWhenArgsIsNull() 
    {
        # Arrange:
        $builder = new StringBuilder();
        
        # Act:
        $builder->appendFormat("{0}", null);
    }

    /**
     * @test
    */
    public function AppendFormat_ShouldAppendOneElement() 
    {
        # Arrange:
        $text = "dotneton{0}";
        $builder = new StringBuilder;
    
        # Act:
        $builder->appendFormat($text, array("php"));
    
        # Assert:
        $this->assertEquals("dotnetonphp", $builder->toString());
    }

    /**
     * @test
    */
    public function AppendFormat_ShouldAppendManyElements() 
    {
        # Arrange:
        $text = "{0}{1}{2}{3}";
        $builder = new StringBuilder;
    
        # Act:
        $builder->appendFormat($text, array("dot", "net", "on", "php"));
    
        # Assert:
        $this->assertEquals("dotnetonphp", $builder->toString());
    }

    /**
     * @test
    */
    public function AppendFormat_ShouldUseKeys() 
    {
        # Arrange:
        $text = "{{0}}";
        $builder = new StringBuilder;
    
        # Act:
        $builder->appendFormat($text, array("dotnetonphp"));
    
        # Assert:
        $this->assertEquals("{dotnetonphp}", $builder->toString());
    }

    /**
     * @test
    */
    public function AppendLine_ShouldAppendLineWithoutText() 
    {
        # Arrange:
        $builder = new StringBuilder;
    
        # Act:
        $builder->appendLine();

    
        # Assert:
        $this->assertEquals(PHP_EOL, $builder->toString());
    }

    /**
     * @test
    */
    public function AppendLine_ShouldAppendLineWithText() 
    {
        # Arrange:
        $builder = new StringBuilder;
    
        # Act:
        $builder->appendLine("dotnetonphp");

    
        # Assert:
        $this->assertEquals("dotnetonphp".PHP_EOL, $builder->toString());
    }


    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Capacity_ThrowsExceptionWhenCapacityIsLessThanZero() 
    {
        # Arrange:
        $capacity = -1;
        $builder = new StringBuilder;
    
        # Act:
        $builder->capacity($capacity);
    }
    

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Capacity_ThrowsExceptionWhenCapacityIsLessThanLength() 
    {
        # Arrange:
        $builder = new StringBuilder;
        $builder->append("dotnetonphp");
    
        # Act:
        $builder->capacity(1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Capacity_ThrowsExceptionWhenExceedMaxCapacity() 
    {
        # Arrange:
        $builder = new StringBuilder(2);
    
        # Act:
        $builder->capacity(10);
    }

   
    /**
     * @test
    */
    public function Capacity_ShouldChangeSizeOfCapacity() 
    {
        # Arrange:
        $builder = new StringBuilder;
    
        # Act:
        $builder->capacity(10);
    
        # Assert:
        $this->assertEquals(10, $builder->capacity());
    }

    // /**
    //  * @test
    // */
    // public function ThrowsExceptionCopyBecauseSourceIndexIsLessThanZero() {
    //     $this->setExpectedException("ArgumentOutOfRangeException");
    //     $char = array("a");
    //     $builder = new StringBuilder();
    //     $builder->append("PhpOnDotNet");
    //     $builder->copyTo(-1, $char, 0, 1);
    // }

    // /**
    //  * @test
    // */
    // public function ThrowsExceptionCopyBecauseDestinationIndexIsLessThanZero() {
    //     $this->setExpectedException("ArgumentOutOfRangeException");
    //     $char = array("a");
    //     $builder = new StringBuilder();
    //     $builder->append("PhpOnDotNet");
    //     $builder->copyTo(1, $char, -1, 5);
    // }

    // /**
    //  * @test
    // */
    // public function ThrowsExceptionWhenCopyBecauseSourceIndexGreaterThanStringLength() {
    //     $this->setExpectedException("ArgumentOutOfRangeException");
    //     $char = array("a");
    //     $builder = new StringBuilder();
    //     $builder->append("Php");
    //     $builder->copyTo(5, $char, 0, 2);
    // }

    // /**
    //  * @test
    // */
    // public function ThrowsExceptionWhenCopyBecauseSourceIndexPlusCountGreaterThanStringLength() {
    //     $this->setExpectedException("ArgumentException");
    //     $char = array("a");
    //     $builder = new StringBuilder();
    //     $builder->append("Php");
    //     $builder->copyTo(0, $char, 0, 8);
    // }

    // /**
    //  * @test
    // */
    // public function ThrowsExceptionWhenCopyBecauseDestinationIndexGreaterThanArraySize() {
    //     $this->setExpectedException("ArgumentException");
    //     $char = array("a");
    //     $builder = new StringBuilder();
    //     $builder->append("Php");
    //     $builder->copyTo(0, $char, 2, 2);
    // }

    // /**
    //  * @test
    // */
    // public function WhenCopyShouldBeReplaceOldValue() {
    //     $char = array("a", "b", "c", "d", "e", "f", "g", "h");
    //     $builder = new StringBuilder();
    //     $builder->append("Php");
    //     $this->assertEquals("a", $char[0]);
    //     $builder->copyTo(0, $char, 0, 3);
    //     $this->assertEquals("P", $char[0]);
    // }

    // /**
    //  * @test
    // */
    // public function ThrowsExceptionWhenEnsureCapacityBecauseCapacityIsLessThanZero() {
    //     $this->setExpectedException("ArgumentOutOfRangeException");
    //     $builder = new StringBuilder(10);
    //     $builder->ensureCapacity(-1);
    // }

    // /**
    //  * @test
    // */
    // public function ThrowsExceptionEnsureCapacityBecauseCapacityIsGreaterThanMaxCapacity() {
    //     $this->setExpectedException("ArgumentOutOfRangeException");
    //     $builder = new StringBuilder(10);
    //     $builder->ensureCapacity(20);
    // }

    // /**
    //  * @test
    // */
    // public function WhenEnsureCapacityThenCapacityShouldBeModified() {
    //     $builder = new StringBuilder();
    //     $builder->ensureCapacity(20);
    //     $this->assertEquals(20, $builder->capacity());
    // }

    // /**
    //  * @test
    // */
    // public function WhenInsertTheTextShouldBeModified() {
    //     $builder = new StringBuilder();
    //     $builder->append("dotNet");
    //     $builder->insert(0, "On");
    //     $builder->insert(0, "Php");
    //     $this->assertEquals("PhpOndotNet", $builder->toString());
    // }

    // /**
    //  * @test
    // */
    // public function WhenTrucateTheTextShouldBeClear() {
    //     $builder = new StringBuilder();
    //     $builder->append("dotNet");
    //     $builder->length(2);
    //     $this->assertEquals("do", $builder->toString());
    // }

    // /**
    //  * @test
    // */
    // public function ThrowsExceptionWhenTruncateStringBecauseSizeIsLessThanZero() {
    //     $this->setExpectedException("ArgumentOutOfRangeException");
    //     $builder = new StringBuilder();
    //     $builder->append("dotNet");
    //     $builder->length(-1);
    // }

    // /**
    //  * @test
    // */
    // public function ThrowsExceptionWhenTruncateStringBecauseSizeIsGreatherThanLength() {
    //     $this->setExpectedException("ArgumentOutOfRangeException");
    //     $builder = new StringBuilder();
    //     $builder->append("dotNet");
    //     $builder->length(50);
    // }

    // /**
    //  * @test
    // */
    // public function ThrowsExceptionWhenRemoveStringsBecauseStartIndexIsLessThanZero() {
    //     $this->setExpectedException("ArgumentOutOfRangeException");
    //     $builder = new StringBuilder();
    //     $builder->append("dotNet");
    //     $builder->remove(-1, 3);
    // }

    // /**
    //  * @test
    // */
    // public function ThrowsExceptionWhenRemoveStringsBecauseLengthIsLessThanZero() {
    //     $this->setExpectedException("ArgumentOutOfRangeException");
    //     $builder = new StringBuilder();
    //     $builder->append("dotNet");
    //     $builder->remove(0, -1);
    // }

    // /**
    //  * @test
    // */
    // public function ThrowsExceptionWhenRemoveStringsBecauseLengthIsGreaterThanLength() {
    //     $this->setExpectedException("ArgumentOutOfRangeException");
    //     $builder = new StringBuilder();
    //     $builder->append("dotNet");
    //     $builder->remove(0, 10);
    // }

    // /**
    //  * @test
    // */
    // public function WhenRemoveStringTheResultShouldBePartOfTheText() {
    //     $builder = new StringBuilder();
    //     $builder->append("dotNet");
    //     $oldBuilder = $builder->remove(0, 3);
    //     $this->assertEquals("dotNet", $oldBuilder->toString());
    // }

    // /**
    //  * @test
    // */
    // public function WhenReplaceTheOldValueShouldBeEqualNewValue() {
    //     $builder = new StringBuilder();
    //     $builder->append("dotNet");
    //     $builder->replace("N", "n");
    //     $this->assertEquals("dotnet", $builder->toString());
    // }

    // /**
    //  * @test
    // */
    // public function CantReplaceStringsBecauseStartIndexLessThanZero() {
    //     $this->setExpectedException("ArgumentOutOfRangeException");
    //     $builder = new StringBuilder();
    //     $builder->append("dotNet");
    //     $oldBuilder = $builder->replace("N", "n", -1, 10);
    //     $this->assertEquals("dotnet", $builder->toString());
    // }

    // /**
    //  * @test
    // */
    // public function CantReplaceStringsBecauseCountLessThanZero() {
    //     $this->setExpectedException("ArgumentOutOfRangeException");
    //     $builder = new StringBuilder();
    //     $builder->append("dotNet");
    //     $oldBuilder = $builder->replace("N", "n", 0, -1);
    //     $this->assertEquals("dotnet", $builder->toString());
    // }

    // /**
    //  * @test
    // */
    // public function CantReplaceStringsBecauseStartIndexPlusCountIsGreaterThanLength() {
    //     $this->setExpectedException("ArgumentOutOfRangeException");
    //     $builder = new StringBuilder();
    //     $builder->append("dotNet");
    //     $oldBuilder = $builder->replace("N", "n", 5, 10);
    //     $this->assertEquals("dotnet", $builder->toString());
    // }

    // /**
    //  * @test
    // */
    // public function CanReplaceStringsInRange() {
    //     $builder = new StringBuilder();
    //     $builder->append("dotnetonphp");
    //     $oldBuilder = $builder->replace("n", "+", 4, 5);
    //     $this->assertEquals("dotneto+php", $builder->toString());
    // }

    // /**
    //  * @test
    // */
    // public function CantGetPositionOfString() {
    //     $this->setExpectedException("IndexOutOfRangeException");
    //     $builder = new StringBuilder();
    //     $builder->append("dotnetonphp");
    //     $builder->get(30);
    // }

    // /**
    //  * @test
    // */
    // public function CanGetPositionOfString() {
    //     $builder = new StringBuilder();
    //     $builder->append("dotnetonphp");
    //     $this->assertEquals("t", $builder->get(2));
    // }

}
