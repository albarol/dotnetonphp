<?php

require_once(dirname(__FILE__) . '/../../../src/Autoloader.php');

use \System\Xml\XmlElement as XmlElement;

class XmlElementFixture extends PHPUnit_Framework_TestCase {

	private $dom;

	public function setUp() {
		$this->dom = new \DOMDocument();
		$this->dom->preserveWhiteSpace = false;
		$this->dom->loadXml("<books>
					  <book id='1'>
						  <author>Jack Herrington</author>
						  <title>PHP Hacks</title>
						  <publisher>O'Reilly</publisher>
					  </book>
					  <book id='2'>
						  <author>Jack Herrington</author>
						  <title>Podcasting Hacks</title>
						  <publisher>O'Reilly</publisher>
					  </book>
					  </books>");
	}

    
    public function test_Construct_CanConstructElement() {
    	# Arrange:
    	$first_book = $this->dom->getElementsByTagName('book')->item(0);
    	
    	# Act:
    	$element = new XmlElement($first_book);

    	# Assert:
    	$this->assertEquals("Jack HerringtonPHP HacksO'Reilly", $element->value());
    }

    public function test_Attributes_CanCountAttributesFromElement() {
    	# Arrange:
    	$first_book = $this->dom->getElementsByTagName('book')->item(0);
    	
    	# Act:
    	$element = new XmlElement($first_book);

    	# Assert:
    	$this->assertEquals(1, $element->attributes()->count());
    }

    public function test_Attributes_CanGetOneAttributeFromElement() {
    	# Arrange:
    	$first_book = $this->dom->getElementsByTagName('book')->item(0);
    	$element = new XmlElement($first_book);
    	
    	# Act:
    	$attribute = $element->attributes()->itemOf(0);

    	# Assert:
    	$this->assertEquals(1, $attribute->value());
    }

    public function test_BaseURI_CanGetBaseURI() {
    	# Arrange:
    	$first_book = $this->dom->getElementsByTagName('book')->item(0);
    	$filename   = 'file:///'. str_replace('\\', '/', dirname(__FILE__)).'/';
    	    	
    	# Act:
    	$element = new XmlElement($first_book);

    	# Assert:
    	$this->assertEquals($filename, $element->baseURI());
    }

    public function test_ChildNodes_CanCountChildNodes() {
    	# Arrange:
    	$first_book = $this->dom->getElementsByTagName('book')->item(0);
    	    	
    	# Act:
    	$element = new XmlElement($first_book);

    	# Assert:
    	$this->assertEquals(3, $element->childNodes()->count());	
    }

    public function test_ChildNodes_CanGetSpecifNode() {
    	# Arrange:
    	$first_book = $this->dom->getElementsByTagName('book')->item(0);
    	$element = new XmlElement($first_book);
    	    	
    	# Act:
    	$node = $element->childNodes()->item(0);

    	# Assert:
    	$this->assertEquals('Jack Herrington', $node->value());
    }

    public function test_FirstChild_CanGetFirstChild() {
    	# Arrange:
    	$first_book = $this->dom->getElementsByTagName('book')->item(0);
    	$element = new XmlElement($first_book);
    	    	
    	# Act:
    	$node = $element->firstChild();

    	# Assert:
    	$this->assertEquals('Jack Herrington', $node->value());	
    }

    public function test_HasAttributes_ShouldHaveAttributes() {
    	# Arrange:
    	$first_book = $this->dom->getElementsByTagName('book')->item(0);
    	
    	# Act:
    	$element = new XmlElement($first_book);

    	# Assert:
    	$this->assertEquals(true, $element->hasAttributes());		
    }

    public function test_HasAttributes_ShouldNotHaveAttributes() {
    	# Arrange:
    	$first_book = $this->dom->getElementsByTagName('book')->item(0);
    	$element = new XmlElement($first_book);
    	
    	# Act:
    	$node = $element->firstChild();

    	# Assert:
    	$this->assertEquals(false, $node->hasAttributes());	
    }

    public function test_HasChildNodes_ShouldHaveChildNodes() {
    	# Arrange:
    	$first_book = $this->dom->getElementsByTagName('book')->item(0);
    	
    	
    	# Act:
    	$element = new XmlElement($first_book);

    	# Assert:
    	$this->assertEquals(true, $element->hasChildNodes());
    }

    public function test_HasChildNodes_ShouldNotHaveChildNodes() {
    	# Arrange:
    	$first_book = $this->dom->getElementsByTagName('book')->item(0);
    	$element = new XmlElement($first_book);
    	
    	# Act:
    	$node = $element->firstChild()->firstChild();

    	# Assert:
    	$this->assertEquals(false, $node->hasChildNodes());	
    }

    public function test_InnerText_CanGetInnerText() {
    	# Arrange:
    	$first_book = $this->dom->getElementsByTagName('book')->item(0);
    	    	
    	# Act:
    	$element = new XmlElement($first_book);

    	# Assert:
    	$this->assertEquals("Jack HerringtonPHP HacksO'Reilly", $element->innerText());
    }

    /*public function test_InnerXml_CanGetInnerXml() {
    	# Arrange:
    	$first_book = $this->dom->getElementsByTagName('book')->item(0);
    	$expected = "<author>Jack Herrington</author><title>PHP Hacks</title><publisher>O'Reilly</publisher>";
    	    	
    	# Act:
    	$element = new XmlElement($first_book);

    	# Assert:
    	$this->assertEquals($expected, $element->innerXml());
    }*/
}