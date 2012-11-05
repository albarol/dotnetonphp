<?php

require_once dirname(__FILE__) . '/../../src/Autoloader.php';

use \System\String as String;
use \System\TypeCode as TypeCode;

class StringFixture extends PHPUnit_Framework_TestCase {

    public function test_IsNullOrEmpty_ShouldTrueWhenStringIsNull() {
        # Arrange:
        $string = null;

        # Act:
        $result = String::isNullOrEmpty($string);

        # Assert:
        $this->assertTrue($result);
    }

    public function test_IsNullOrEmpty_ShouldTrueWhenStringIsEmpty() {
        #Arrange:
        $string = String::getEmpty();
        
        # Act:
        $result = String::isNullOrEmpty($string);

        # Assert:
        $this->assertTrue($result);
    }

    public function test_Concat_ShouldConcatStrings() {
        # Arrange
        $words = array("dotnet", "onphp");
        
        # Act:
        $obj = String::concat($words[0], $words[1]);
        
        # Assert:
        $this->assertEquals("dotnetonphp", $obj->value());
    }

    public function test_Contains_ShouldBeTrueWhenContainsValue() {
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $result = $obj->contains("dot");

        # Assert:
        $this->assertTrue($result);
    }

    public function test_Contains_ShouldBeFalseWhenNotContainsValue() {
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $result = $obj->contains("hook");

        # Assert:
        $this->assertFalse($result);
    }

    public function test_CompareOrdinal_ShouldBeMinusOne() {
        # Arrange
        $words = array("dotnet", "onphp");
        
        # Act:
        $result = String::compareOrdinal($words[0], $words[1]);
        
        # Assert:
        $this->assertEquals(-1, $result);
    }

    public function test_CompareOrdinal_ShouldBeOne() {
        # Arrange
        $words = array("dotnet", "onphp");
        
        # Act:
        $result = String::compareOrdinal($words[1], $words[0]);
        
        # Assert:
        $this->assertEquals(1, $result);
    }

    public function test_CompareOrdinal_ShouldBeZero() {
        # Arrange
        $words = array("dotnet", "onphp");
        
        # Act:
        $result = String::compareOrdinal($words[1], $words[1]);
        
        # Assert:
        $this->assertEquals(0, $result);
    }

    public function test_CompareTo_ShouldBeMinusOne() {
        # Arrange
        $str = new String("dotnet");
        $word = "onphp";
        
        # Act:
        $result = $str->compareTo($word);
        
        # Assert:
        $this->assertEquals(-1, $result);
    }

    public function test_CompareTo_ShouldBeOne() {
        # Arrange
        $str = new String("onphp");
        $word = "dotnet";
        
        # Act:
        $result = $str->compareTo($word);
        
        # Assert:
        $this->assertEquals(1, $result);
    }

    public function test_CompareTo_ShouldBeZero() {
        # Arrange
        $str = new String("dotnet");
        $word = "dotnet";
        
        # Act:
        $result = $str->compareTo($word);
        
        # Assert:
        $this->assertEquals(0, $result);
    }

    public function test_Copy_CanCreateCopyOfString() {
        # Arrange
        $str = new String("dotnetonphp");
        
        # Act:
        $obj = String::copy($str);
        
        # Assert:
        $this->assertEquals("dotnetonphp", $obj->value());
    }

    public function test_Equals_ShouldBeTrueWhenInstancesAreEqual() {
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $result = $obj->equals(new String("dotnetonphp"));

        # Assert:
        $this->assertTrue($result);
    }

   public function test_Equals_ShouldBeTrueWhenInstancesAreNotEqual() {
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $result = $obj->equals(new String("hook"));

        # Assert:
        $this->assertFalse($result);
    }

    public function test_IndexOf_ShouldReturnPositionWhenCharExists() {
        # Arrange:
        $obj = new String(".Net#On#Php");
        $char = "#";

        # Act:
        $position = $obj->indexOf($char);

        # Assert:
        $this->assertEquals(4, $position);
    }

    public function test_IndexOf_ShouldReturnPositionWhenCharNotExists() {
        # Arrange:
        $obj = new String(".Net#On#Php");
        $char = "+";

        # Act:
        $position = $obj->indexOf($char);

        # Assert:
        $this->assertEquals(-1, $position);
    }

    
    public function test_ToCharArray_CanTransformStringInCharArray() {
        # Arrange:
        $obj = new String('DotNetOnPhp');

        # Act:
        $array = $obj->toCharArray();

        # Assert:
        $this->assertEquals("D", $array[0]);
        $this->assertEquals("N", $array[3]);
        $this->assertEquals("O", $array[6]);
        $this->assertEquals("P", $array[8]);
    }

    public function test_ToUpper_CanTransformInUpperCase() {
        # Arrange:
        $obj = new String("DoTnEtOnPhP");

        # Act:
        $result = $obj->toUpper();

        # Assert:
        $this->assertEquals("DOTNETONPHP", $result->value());
    }

    public function test_ToLower_CanTransformInLowerCase() {
        # Arrange:
        $obj = new String("DoTnEtOnPhP");

        # Act:
        $result = $obj->toLower();

        # Assert:
        $this->assertEquals("dotnetonphp", $result->value());
    }

    public function test_Length_CanGetLengthOfString() {
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $length = $obj->length();

        # Assert:
        $this->assertEquals(11, $length);
    }

    
    public function test_Replace_CanReplacePartOfString() {
        # Arrange:
        $obj = new String("dotneton###");

        # Act:
        $text = $obj->replace("###", "php");

        # Assert:
        $this->assertEquals("dotnetonphp", $text->value());
    }

    
    public function test_Replace_ThrowsExceptionWhenArgumentIsNull() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentNullException");
        $obj = new String("dotnetonphp");

        # Act::
        $obj->replace(null, "php");
    }

    
    public function test_Trim_CanRemoveSpacesFromBoundaries() {
        # Arrange:
        $obj = new String("    dot net on php   ");

        # Act:
        $text = $obj->trim();

        # Assert:
        $this->assertEquals("dot net on php", $text->value());
    }

    public function test_Remove_CanRemovePartOfString() {
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $text = $obj->remove(3);
        
        # Assert:
        $this->assertEquals("dot", $text->value());
    }

    public function test_Remove_ThrowsExceptionWhenPositionIsInvalid() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $obj = new String("dotnetonphp");

        # Act:
        $obj->remove(-1);
    }

    public function test_Chars_ThrowsExceptionWhenPositionIsInvalid() {
        # Arrange:
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $obj = new String("dotnetonphp");

        # Act:
        $obj->chars(-1);
    }

    public function test_Chars_CanGetCharInPosition() {
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $char = $obj->chars(0);

        # Assert:
        $this->assertEquals("d", $char);
    }

    public function test_GetTypeCode_CanGetTypeCodeToString() {
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $code = $obj->getTypeCode();

        # Assert:
        $this->assertEquals(TypeCode::string(), $code);
    }
}
