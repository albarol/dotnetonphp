<?php

use \System\String as String;
use \System\TypeCode as TypeCode;
use \System\InvalidOperationException as InvalidOperationException;

use \System\Text\NormalizationForm as NormalizationForm;

/**
 * @group core
*/
class StringTestCase extends PHPUnit_Framework_TestCase {

    
    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
     */
    public function Chars_ThrowsExceptionWhenPositionIsInvalid() {
        
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $obj->chars(-1);
    }

    /**
     * @test
     */
    public function Chars_CanGetCharInPosition() {
        
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $char = $obj->chars(0);

        # Assert:
        $this->assertEquals("d", $char);
    }

    /**
     * @test
     */
    public function Concat_ShouldConcatStrings() {
        
        # Arrange
        $words = array("dotnet", "onphp");
        
        # Act:
        $obj = String::concat($words[0], $words[1]);
        
        # Assert:
        $this->assertEquals("dotnetonphp", $obj->value());
    }

    /**
     * @test
     */
    public function Contains_ShouldBeTrueWhenContainsValue() {
        
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $result = $obj->contains("dot");

        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function Contains_ShouldBeFalseWhenNotContainsValue() {
        
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $result = $obj->contains("hook");

        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function CompareOrdinal_ShouldBeMinusOne() {
        
        # Arrange
        $words = array("dotnet", "onphp");
        
        # Act:
        $result = String::compareOrdinal($words[0], $words[1]);
        
        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
     */
    public function CompareOrdinal_ShouldBeOne() {
        
        # Arrange
        $words = array("dotnet", "onphp");
        
        # Act:
        $result = String::compareOrdinal($words[1], $words[0]);
        
        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function CompareOrdinal_ShouldBeZero() {
        
        # Arrange
        $words = array("dotnet", "onphp");
        
        # Act:
        $result = String::compareOrdinal($words[1], $words[1]);
        
        # Assert:
        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function CompareTo_ShouldBeMinusOne() {
        
        # Arrange
        $str = new String("dotnet");
        $word = "onphp";
        
        # Act:
        $result = $str->compareTo($word);
        
        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
     */
    public function CompareTo_ShouldBeOne() {
        
        # Arrange
        $str = new String("onphp");
        $word = "dotnet";
        
        # Act:
        $result = $str->compareTo($word);
        
        # Assert:
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function CompareTo_ShouldBeZero() {
        
        # Arrange
        $str = new String("dotnet");
        $word = "dotnet";
        
        # Act:
        $result = $str->compareTo($word);
        
        # Assert:
        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function Copy_CanCreateCopyOfString() {
        
        # Arrange
        $str = new String("dotnetonphp");
        
        # Act:
        $obj = String::copy($str);
        
        # Assert:
        $this->assertEquals("dotnetonphp", $obj->value());
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
     */
    public function CopyTo_ThrowsExceptionWhenSourceIndexIsNegative() {
        
        # Arrange
        $str = new String("dotnetonphp");
        
        # Act:
        $str->copyTo(-1, 1, 10);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
     */
    public function CopyTo_ThrowsExceptionWhenDestinationIndexIsNegative() {
        
        # Arrange
        $str = new String("dotnetonphp");
        
        # Act:
        $str->copyTo(0, -1, 10);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
     */
    public function CopyTo_ThrowsExceptionWhenCountIsNegative() {
        
        # Arrange
        $str = new String("dotnetonphp");
        
        # Act:
        $str->copyTo(0, 0, -1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
     */
    public function CopyTo_ThrowsExceptionWhenCountIsGreaterThanSize() {
        
        # Arrange
        $str = new String("dotnetonphp");
        
        # Act:
        $str->copyTo(9, 0, 3);
    }

    /**
     * @test
     */
    public function CopyTo_CanCopyPartOfStringToArray() {
        # Arrange
        $str = new String("dotnetonphp");
        
        # Act:
        $destination = $str->copyTo(0, 0, 3);

        # Assert:
        $this->assertEquals('dot', implode("", $destination));
    }

    /**
     * @test
     */
    public function GetTypeCode_CanGetTypeCodeToString() {
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $code = $obj->getTypeCode();

        # Assert:
        $this->assertEquals(TypeCode::string(), $code);
    }

    /**
     * @test
     */
    public function EndsWith_ShouldBeTrueIfStringEndsWith() {
        # Arrange
        $obj = new String("dotnetonphp");

        # Act:
        $result = $obj->endsWith("php");
    
        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function EndsWith_ShouldBeFalseIfStringNotEndsWith() {
        # Arrange
        $obj = new String("dotnetonphp");

        # Act:
        $result = $obj->endsWith("dot");
    
        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function Equals_ShouldBeTrueWhenInstancesAreEqual() {
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $result = $obj->equals(new String("dotnetonphp"));

        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function Equals_ShouldBeTrueWhenInstancesAreNotEqual() {
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $result = $obj->equals(new String("hook"));

        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
     */
    public function Format_ThrowsExceptionWhenFormatIsNull() {
        
        # Arrange
        # Act:
        String::format(null, array("a"));
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
     */
    public function Format_ThrowsExceptionWhenArgumentIsNull() {
        
        # Arrange
        # Act:
        String::format("X", array());
    }

    /**
     * @test
     */
    public function Format_CanFormatArgument() {
        $this->markTestIncomplete();
    }

    /**
     * @test
     */
    public function GetEnumerator_CanGetEnumerator() {
        
        # Arrange
        $obj = new String("dotnetonphp");
                
        # Act:
        $enumerator = $obj->getEnumerator();
    
        # Assert:
        $this->assertTrue($enumerator instanceof \System\Collections\IEnumerator);
    }

    /**
     * @test
     */
    public function IndexOf_ShouldReturnPositionWhenCharExists() {
        
        # Arrange:
        $obj = new String(".Net#On#Php");
        $char = "#";

        # Act:
        $position = $obj->indexOf($char);

        # Assert:
        $this->assertEquals(4, $position);
    }

    /**
     * @test
     */
    public function IndexOf_ShouldReturnPositionWhenCharNotExists() {
        
        # Arrange:
        $obj = new String(".Net#On#Php");
        $char = "+";

        # Act:
        $position = $obj->indexOf($char);

        # Assert:
        $this->assertEquals(-1, $position);
    }

    /**
     * @test
     */
    public function IndexOf_ShouldReturnPositionWhenStartIndexIsGreaterThanZero() {
        
        # Arrange
        $obj = new String("dotnetonphp");
                
        # Act:
        $position = $obj->indexOf('p', 2);
    
        # Assert:
        $this->assertEquals(8, $position);
    }

    /**
     * @test
     */
    public function IndexOf_ShouldReturnPositionInSpecificRange() {
        
        # Arrange
        $obj = new String("dotnetonphp");
                
        # Act:
        $position = $obj->indexOf('t', 3, 3);
    
        # Assert:
        $this->assertEquals(5, $position);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
     */
    public function IndexOfAny_ThrowsExceptionWhenStartIndexIsNegative() {
        
        # Arrange
        $obj = new String("dotnetonphp");
        
        # Act:
        $obj->indexOfAny(array('n', 'e', 't'), -1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
     */
    public function IndexOfAny_ThrowsExceptionWhenStartIndexIsGreaterThanLength() {
        
        # Arrange
        $obj = new String("dotnetonphp");
        
        # Act:
        $obj->indexOfAny(array('n', 'e', 't'), 12);
    }

    /**
     * @test
     */
    public function IndexOfAny_ShouldBeTrueWhenLookAllString() {
        
        # Arrange
        $obj = new String("dotnetonphp");
                
        # Act:
        $result = $obj->indexOfAny(array('n', 'e', 't'), 0);

        # Assert:
        $this->assertEquals(3, $result);
    }

    /**
     * @test
     */
    public function IndexOfAny_ShouldBeTrueWhenLookPartOfString() {
        
        # Arrange
        $obj = new String("dotnetonphp");
                
        # Act:
        $result = $obj->indexOfAny(array('n', 'e', 't'), 2);

        # Assert:
        $this->assertEquals(3, $result);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
     */
    public function Insert_ThrowsExceptionWhenValueIsNull() {
        
        # Arrange
        $obj = new String("dotnetonphp");
                
        # Act:
        $obj->insert(0, null);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
     */
    public function ThrowsExceptionWhenStartIndexIsGreaterThanSizeOfString() {
        
        # Arrange
        $obj = new String("dotnetonphp");

        # Act:
        $obj->insert(12, "new_value");
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
     */
    public function Insert_ThrowsExceptionWhenStartIndexIsNegative() {
        
        # Arrange
        $obj = new String("dotnetonphp");

        # Act:
        $obj->insert(-1, "new_value");
    }

    /**
     * @test
     */
    public function Insert_CanInsertElementsInString() {
        
        # Arrange
        $obj = new String("dotnet");

        # Act:
        $new_string = $obj->insert(6, "onphp");
    
        # Assert:
        $this->assertEquals("dotnetonphp", $new_string->value());
    }

    /**
     * @test
     */
    public function IsNormalized_VerifyIfIsNormalizedInFormC() {
        $this->markTestIncomplete();
        
        # Arrange
        $obj = new String("á");

        # Act:
        $result = $obj->isNormalized(NormalizationForm::formC());
    
        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function IsNormalized_VerifyIfIsNormalizedInFormD() {
        $this->markTestIncomplete();

        # Arrange
        $obj = new String("á");

        # Act:
        $result = $obj->isNormalized(NormalizationForm::formD());
    
        # Assert:
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function IsNullOrEmpty_ShouldTrueWhenStringIsNull() {
        # Arrange:
        $string = null;

        # Act:
        $result = String::isNullOrEmpty($string);

        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function IsNullOrEmpty_ShouldTrueWhenStringIsEmpty() {
        #Arrange:
        $string = String::getEmpty();
        
        # Act:
        $result = String::isNullOrEmpty($string);

        # Assert:
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function Join_ThrowsExceptionWhenStartIndexIsLessThanZero() {
        
        # Arrange
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $value = array('dotnet', 'onphp');
        
        # Act:
        String::join('', $value, -1);
    }

    /**
     * @test
     */
    public function Join_ThrowsExceptionWhenStartIndexPlusCountIsGreaterThanArrayLength() {
        
        # Arrange
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $value = array('dotnet', 'onphp');
        
        # Act:
        String::join('', $value, 0, 3);
    }

    /**
     * @test
     */
    public function Join_CanJoinValuesWithSeparator() {
        
        # Arrange
        $value = array('dot', 'net', 'on', 'php');
                
        # Act:
        $obj = String::join('', $value);
    
        # Assert:
        $this->assertEquals("dotnetonphp", $obj->value());
    }

    /**
     * @test
     */
    public function Join_CanJoinValuesWithSeparatorAndIndex() {
        
        # Arrange
        $value = array('dot', 'net', 'on', 'php');
                
        # Act:
        $obj = String::join('', $value, 1);
    
        # Assert:
        $this->assertEquals("netonphp", $obj->value());
    }

    /**
     * @test
     */
    public function Join_CanJoinValuesWithSeparatorAndIndexAndCount() {
        
        # Arrange
        $value = array('dot', 'net', 'on', 'php');
                
        # Act:
        $obj = String::join(',', $value, 0, 2);
    
        # Assert:
        $this->assertEquals("dot,net", $obj->value());
    }

    /**
     * @test
     */
    public function LastIndexOf_ThrowsExceptionWhenStartIndexIsNegative() {

        # Arrange
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $obj = new String("dotnetonphp");
        
        # Act:
        $obj->lastIndexOf('p', -1);
    }

    /**
     * @test
     */
    public function LastIndexOf_CanGetLastPositionOfString() {
       
        # Arrange
        $obj = new String("dotnetonphp");
                
        # Act:
        $result = $obj->lastIndexOf('p');
        
        # Assert:
        $this->assertEquals(10, $result);
    }

    /**
     * @test
     */
    public function LastIndexOf_CanGetLastPositionInRange() {
        
        # Arrange
        $obj = new String("dotnetonphp");
                
        # Act:
        $result = $obj->lastIndexOf('p', 5, 4);
    
        # Assert:
        $this->assertEquals(8, $result);
    }

    /**
     * @test
     */
    public function LastIndexOfAny_ThrowsExceptionWhenStartIndexIsNegative() {
        # Arrange
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $obj = new String("dotnetonphp");
        
        # Act:
        $obj->lastIndexOfAny(array('n', 'e', 't'), -1);
    }

    /**
     * @test
     */
    public function LastIndexOfAny_ThrowsExceptionWhenStartIndexIsGreaterThanLength() {
        # Arrange
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $obj = new String("dotnetonphp");
        
        # Act:
        $obj->lastIndexOfAny(array('n', 'e', 't'), 12);
    }

    /**
     * @test
     */
    public function LastIndexOfAny_ShouldBeTrueWhenLookAllString() {
        
        # Arrange
        $obj = new String("dotnetonphp");
                
        # Act:
        $result = $obj->lastIndexOfAny(array('d'), 1);

        # Assert:
        $this->assertEquals(-1, $result);
    }

    /**
     * @test
     */
    public function Length_CanGetLengthOfString() {
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $length = $obj->length();

        # Assert:
        $this->assertEquals(11, $length);
    }

    /**
     * @test
     */
    public function LastIndexOfAny_ShouldBeTrueWhenLookPartOfString() {
        
        # Arrange
        $obj = new String("dotnetonphp");
                
        # Act:
        $result = $obj->lastIndexOfAny(array('n', 'e', 't'), 2);

        # Assert:
        $this->assertEquals(3, $result);
    }

    /**
     * @test
     */
    public function Normalize_ShouldNormalizeInFormC() {

        $this->markTestIncomplete();
        
        # Arrange
        $latin_letter = "\xCC\x8A";
        $obj = new String("\xCC\x8A");
                
        # Act:
        $normalized = $obj->normalize();
    
        # Assert:
        $this->assertEquals($latin_letter, $normalized->value());
    }

    /**
     * @test
     */
    public function Normalize_ShouldNormalizeInFormD() {

        $this->markTestIncomplete();
        
        # Arrange
        $latin_letter = "\xCC\x8A";
        $obj = new String("\xCC\x8A");
                
        # Act:
        $normalized = $obj->normalize(NormalizationForm::formD());
    
        # Assert:
        $this->assertEquals($latin_letter, $normalized->value());
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
     */
    public function PadLeft_ThrowsExceptionWhenTotalWidthIsLessThanZero() {

        # Arrange
        $width = -1;
        $obj = new String("dotnetonphp");
                
        # Act:
        $obj->padLeft($width);
    }

    /**
     * @test
     */
    public function PadLeft_ShouldIncludeWhiteSpaceInString() {
        
        # Arrange
        $width = 16;
        $obj = new String("dotnetonphp");
                
        # Act:
        $str_pad = $obj->padLeft($width);
    
        # Assert:
        $this->assertEquals(16, $str_pad->length());

    }

    /**
     * @test
     */
    public function PadLeft_ShouldIncludeZeroInSTring() {
        
        # Arrange
        $width = 5;
        $obj = new String("1");
                
        # Act:
        $str_pad = $obj->padLeft($width, "2");
    
        # Assert:
        $this->assertEquals("22221", $str_pad->value());
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
     */
    public function PadRight_ThrowsExceptionWhenTotalWidthIsLessThanZero() {
        
        # Arrange
        $width = -1;
        $obj = new String("dotnetonphp");
                
        # Act:
        $obj->padRight($width);
    }

    /**
     * @test
     */
    public function PadRight_ShouldIncludeWhiteSpaceInString() {
        
        # Arrange
        $width = 16;
        $obj = new String("dotnetonphp");
                
        # Act:
        $str_pad = $obj->padRight($width);
    
        # Assert:
        $this->assertEquals(16, $str_pad->length());

    }

    /**
     * @test
     */
    public function PadRight_ShouldIncludeZeroInSTring() {
        
        # Arrange
        $width = 5;
        $obj = new String("1");
                
        # Act:
        $str_pad = $obj->padRight($width, "2");
    
        # Assert:
        $this->assertEquals("12222", $str_pad->value());
    }

    /**
     * @test
     */
    public function Remove_CanRemovePartOfString() {

        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $text = $obj->remove(3);
        
        # Assert:
        $this->assertEquals("dot", $text->value());
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
     */
    public function Remove_ThrowsExceptionWhenPositionIsInvalid() {
        
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act:
        $obj->remove(-1);
    }

    /**
     * @test
     */
    public function Replace_CanReplacePartOfString() {

        # Arrange:
        $obj = new String("dotneton###");

        # Act:
        $text = $obj->replace("###", "php");

        # Assert:
        $this->assertEquals("dotnetonphp", $text->value());
    }
    
    /**
     * @test
     * @expectedException \System\ArgumentNullException
     */
    public function Replace_ThrowsExceptionWhenArgumentIsNull() {
        
        # Arrange:
        $obj = new String("dotnetonphp");

        # Act::
        $obj->replace(null, "php");
    }

    /**
     * @test
     */
    public function ToCharArray_CanTransformStringInCharArray() {
        
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

    /**
     * @test
     */
    public function ToUpper_CanTransformInUpperCase() {
        
        # Arrange:
        $obj = new String("DoTnEtOnPhP");

        # Act:
        $result = $obj->toUpper();

        # Assert:
        $this->assertEquals("DOTNETONPHP", $result->value());
    }

    /**
     * @test
     */
    public function ToLower_CanTransformInLowerCase() {
        
        # Arrange:
        $obj = new String("DoTnEtOnPhP");

        # Act:
        $result = $obj->toLower();

        # Assert:
        $this->assertEquals("dotnetonphp", $result->value());
    }
    
    /**
     * @test
     */
    public function Trim_CanRemoveSpacesFromBoundaries() {
        
        # Arrange:
        $obj = new String("    dot net on php   ");

        # Act:
        $text = $obj->trim();

        # Assert:
        $this->assertEquals("dot net on php", $text->value());
    }

    /**
     * @test
     */
    public function Trim_CanRemoveLetterFromBoundaries() {
        
        # Arrange:
        $obj = new String("aaaadot net on phpaaaa");
        $trimChars = array('a');

        # Act:
        $text = $obj->trim($trimChars);

        # Assert:
        $this->assertEquals("dot net on php", $text->value());
    }

    /**
     * @test
     */
    public function TrimEnd_CanRemoveSpacesFromRightBoundary() {
        
        # Arrange:
        $obj = new String("    dot net on php   ");

        # Act:
        $text = $obj->trimEnd();

        # Assert:
        $this->assertEquals("    dot net on php", $text->value());
    }

    /**
     * @test
     */
    public function TrimEnd_CanRemoveLetterFromRightBoundary() {
        
        # Arrange:
        $obj = new String("    dot net on phpaaa");
        $trimChars = array('a');

        # Act:
        $text = $obj->trimEnd($trimChars);

        # Assert:
        $this->assertEquals("    dot net on php", $text->value());
    }

    /**
     * @test
     */
    public function TrimStart_CanRemoveSpacesFromLeftBoundary() {
        
        # Arrange:
        $obj = new String("    dot net on php   ");

        # Act:
        $text = $obj->trimStart();

        # Assert:
        $this->assertEquals("dot net on php   ", $text->value());
    }

    /**
     * @test
     */
    public function TrimStart_CanRemoveLetterFromLeftBoundary() {
        
        # Arrange:
        $obj = new String("aaaadot net on php   ");
        $trimChars = array('a');

        # Act:
        $text = $obj->trimStart($trimChars);

        # Assert:
        $this->assertEquals("dot net on php   ", $text->value());
    }
}
