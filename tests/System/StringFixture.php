<?php

//require_once 'PHPUnit/Framework.php';

require_once dirname(__FILE__) . '/../../system/String.php';

class StringFixture extends PHPUnit_Framework_TestCase {

    public function testVerifyIfStringIsNull() {
        $string = null;
        $this->isTrue(String::isNullOrEmpty($string));
    }

    public function testVerifyIfStringIsEmpty() {
        $string = String::getEmpty();
        $this->isTrue(String::isNullOrEmpty($string));
    }

    public function testVerifyIfStringContainsValue() {
        $string = "dotnetonphp";
        $this->isFalse(String::isNullOrEmpty($string));
    }

    public function testWhenHaveStringsWithSameValueEqualsShouldBeTrue() {
        $string = new String("dotnetonphp");
        $this->isTrue($string->equals("dotnetonphp"));
    }

    public function testWhenHaveStringsWithDifferentValueEqualsShouldBeFalse() {
        $string = new String("dotnet");
        $this->isFalse($string->equals(new String("onphp")));
    }

    public function testShouldConcatenateStrings() {
        $string1 = "dotnet";
        $string2 = "onphp";
        $this->assertEquals(String::concat($string1, $string2)->value, "dotnetonphp");
    }

    public function testShouldGettingPositionCharInString() {
        $string = new String(".Net#On#Php");
        $char = "#";
        $this->assertEquals($string->indexOf($char), 4); //found character
    }

    public function testShouldNotGettingPositionCharInString() {
        $string = new String(".Net#On#Php");
        $char = "%";
        $this->assertEquals($string->indexOf($char), -1); //not found character
    }

    public function testStringShouldContainsSubstring() {
        $string = new String(".Net#On#Php");
        $correctSubstring = "#";
        $this->isTrue($string->contains($correctSubstring)); //found substring
    }

    public function testStringShouldNotContainsSubstring() {
        $string = new String(".Net#On#Php");
        $correctSubstring = "%";
        $this->isFalse($string->contains($correctSubstring)); //not found substring
    }

    public function testShouldTransformStringInCharArray() {
        $string = new String('DotNetOnPhp');
        $array = $string->toCharArray();
        $this->assertEquals($array[0], "D");
        $this->assertEquals($array[1], "o");
        $this->assertEquals($array[2], "t");
        $this->assertEquals($array[3], "N");
        $this->assertEquals($array[4], "e");
        $this->assertEquals($array[5], "t");
        $this->assertEquals($array[6], "O");
        $this->assertEquals($array[7], "n");
        $this->assertEquals($array[8], "P");
        $this->assertEquals($array[9], "h");
        $this->assertEquals($array[10], "p");
    }

    public function testShouldTransformStringToUpperCase() {
        $string = new String("DoTnEtOnPhP");
        $this->assertEquals("DOTNETONPHP", $string->toUpper()->value);
    }

    public function testShouldTransformStringToLowerCase() {
        $string = new String("DoTnEtOnPhP");
        $this->assertEquals("dotnetonphp", $string->toLower()->value);
    }

    public function testShouldGetLengthOfString() {
        $texto = new String("dotnetonphp");
        $this->assertEquals(11, $texto->length());
    }

    public function testShouldReplaceAnyPartOfString() {
        $text = new String("dotneton###");
        $this->assertEquals("dotnetonphp", $text->replace("###", "php")->value);
    }

    public function testThrowExceptionWhenReplaceWithNullValue() {
        $this->setExpectedException("ArgumentNullException");
        $text = new String("dotnetonphp");
        $text->replace(null, "php")->value;
    }

    public function testCanConstructObjectByAnyValue() {
        $text = new String("dotnetonphp");
        $newText = new String($text);

        $this->assertEquals("dotnetonphp", $newText->value);
    }

    public function testShouldCloneObject() {
        $text = new String("dotnetonphp");
        $newText = $text->cloneObject();

        $this->assertEquals("dotnetonphp", $newText->value);
    }

    public function testShouldRemoveSpacesFromBoundaries() {
        $text = new String("    dot net on php   ");
        $this->assertEquals("dot net on php", $text->trim()->value);
    }

    public function testShouldRemoveCharsFromString() {
        $string = new String("dotnetonphp");
        $this->assertEquals("dot", $string->remove(3)->value);
    }

    public function testThrowExceptionWhenRemoveContainsInvalidIndex() {
        $this->setExpectedException("ArgumentOutOfRangeException");
        $string = new String("dotnetonphp");
        $this->assertEquals("dot", $string->remove(-1)->value);
    }

    public function testCanGetCharElementInString() {
        $string = new String("dotnetonphp");
        $this->assertEquals("d", $string->chars(0)->value);
    }

    public function testWhenGetTypeCodeShouldBeString(){
        $code = new String("dotnetonphp");
        $this->assertEquals($code->getTypeCode(), Code::string());
    }
}
?>
