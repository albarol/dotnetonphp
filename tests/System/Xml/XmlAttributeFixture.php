<?php

require_once(dirname(__FILE__) . '/../../../src/Autoloader.php');

use \System\Xml\XmlDocument as XmlDocument;
use \System\Xml\XmlElement as XmlElement;
use \System\Xml\XmlAttribute as XmlAttribute;
use \System\Xml\XmlNodeType as XmlNodeType;


class XmlAttributeFixture extends PHPUnit_Framework_TestCase {

	private $element;

	public function setUp() {
		$xml = "<books xmlns:b='http://www.books.com'>
                    <b:book id='1'>
                        <author>Jack Herrington</author>
                        <title>PHP Hacks</title>
                        <publisher>O'Reilly</publisher>
                    </b:book>
                    <b:book id='2'>
                        <author>Jack Herrington</author>
                        <title>Podcasting Hacks</title>
                        <publisher>O'Reilly</publisher>
                    </b:book>
                </books>";

        $document = new XmlDocument;
        $document->preserveWhitespace(false);
		$document->loadXml($xml);
        $this->element = $document->documentElement()->firstChild();
	}

    
	public function test_AppendChild_ThrowsExceptionWhenTryAppendElement() {
        # Arrange:
        $this->setExpectedException('\\System\\InvalidOperationException');
        $attr = $this->element->attributes()->itemOf(0);
        $doc = new XmlDocument;
        $element = $doc->createElement('newElement');
        
        # Act:
        $attr->appendChild($element);
    }

    public function test_AppendChild_ChangeAttributeValueWhenAppendTextNode() {
        # Arrange:
        $attr = $this->element->attributes()->itemOf(0);
        $doc = new XmlDocument;
        $text = $doc->createTextNode('2');
        
        # Act:
        $attr->appendChild($text);

        # Assert:
        $this->assertEquals('12', $attr->value());
    }

    public function test_Clone_CanCloneObject() {
        # Arrange:
        $attr = $this->element->attributes()->itemOf(0);
        
        # Act:
        $clone = $attr->cloneObject();

        # Assert:
        $this->assertEquals($clone->value(), $attr->value());
    }

    public function test_CloneNode_CanCloneNodeRecursively() {
        # Arrange:
        $attr = $this->element->attributes()->itemOf(0);
        
        # Act:
        $clone = $attr->cloneNode(true);

        # Assert:
        $this->assertEquals("id=1", $attr->outerXml());
    }

    public function test_CloneNode_CanCloneParentNode() {
        # Arrange:
        $attr = $this->element->attributes()->itemOf(0);
        
        # Act:
        $clone = $attr->cloneNode(true);

        # Assert:
        $this->assertEquals("id=1", $attr->outerXml());
    }

    /************
    * This part of code is snippet to many tests
    *************
        $xml = "<books xmlns:b='http://www.books.com'>
                        <b:book id='1'>
                            <author>Jack Herrington</author>
                            <title>PHP Hacks</title>
                            <publisher>O'Reilly</publisher>
                        </b:book>
                        <b:book id='2'>
                            <author>Jack Herrington</author>
                            <title>Podcasting Hacks</title>
                            <publisher>O'Reilly</publisher>
                        </b:book>
                    </books>";

        $document = new \DOMDocument;
        $document->loadXml($xml);
        $attr = $document->documentElement->childNodes->item(1)->attributes->item(0);
        $text = $document->createElement("algo", "2");

        $attr->appendChild($text);
        echo $attr->nodeValue;
    */

}