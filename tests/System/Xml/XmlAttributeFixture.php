<?php

require_once(dirname(__FILE__) . '/../../../src/Autoloader.php');

use \System\Xml\XmlDocument as XmlDocument;
use \System\Xml\XmlElement as XmlElement;
use \System\Xml\XmlAttribute as XmlAttribute;
use \System\Xml\XmlNodeType as XmlNodeType;


//TODO: Implement exceptions when node belongs to another XmlDocument

class XmlAttributeFixture extends PHPUnit_Framework_TestCase {

	private $dom;

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

        $this->dom = new \DOMDocument();
		$this->dom->preserveWhiteSpace = false;
		$this->dom->loadXml($xml);
	}

    
	public function test_AppendChild_CanAppendChild() {
        # Arrange:
        $first_element = new XmlElement($this->dom->getElementsByTagName('book')->item(0));
        
        # Act:
        $first_element->appendChild();


        # Assert:
        $this->assertEquals(4, $first_element->childNodes()->count());
    }


}