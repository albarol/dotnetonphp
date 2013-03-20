<?php

use \System\Xml\XmlDocument as XmlDocument;
use \System\Xml\XmlElement as XmlElement;
use \System\Xml\XmlAttribute as XmlAttribute;
use \System\Xml\XmlNodeType as XmlNodeType;


class XmlAttributeFixture extends PHPUnit_Framework_TestCase 
{
	private $element;
    private $document;

	public function setUp() 
    {
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

        $this->document = new XmlDocument;
        $this->document->preserveWhitespace(false);
		$this->document->loadXml($xml);
        $this->element = $this->document->documentElement()->firstChild();
	}

    
	/**
     * @test
     * @expectedException \System\InvalidOperationException
    */
    public function AppendChild_ThrowsExceptionWhenTryAppendElement() 
    {
        # Arrange:
        $attr = $this->element->attributes()->itemOf(0);
        $element = $this->document->createElement('newElement');
        
        # Act:
        $attr->appendChild($element);
    }

    /**
     * @test
    */
    public function AppendChild_ChangeAttributeValueWhenAppendTextNode()
    {
        # Arrange:
        $attr = $this->element->attributes()->itemOf(0);
        $text = $this->document->createTextNode('2');
        
        # Act:
        $attr->appendChild($text);

        # Assert:
        $this->assertEquals('12', $attr->value());
    }

    /**
     * @test
    */
    public function Clone_CanCloneObject() 
    {
        # Arrange:
        $attr = $this->element->attributes()->itemOf(0);
        
        # Act:
        $clone = $attr->cloneObject();

        # Assert:
        $this->assertEquals($clone->value(), $attr->value());
    }

    /**
     * @test
    */
    public function CloneNode_CanCloneNodeRecursively() 
    {
        # Arrange:
        $attr = $this->element->attributes()->itemOf(0);
        
        # Act:
        $clone = $attr->cloneNode(true);

        # Assert:
        $this->assertEquals("id=1", $attr->outerXml());
    }

    /**
     * @test
    */
    public function CloneNode_CanCloneParentNode() 
    {
        # Arrange:
        $attr = $this->element->attributes()->itemOf(0);
        
        # Act:
        $clone = $attr->cloneNode(true);

        # Assert:
        $this->assertEquals("id=1", $attr->outerXml());
    }

    /**
     * @test
    */
    public function InsertAfter_CanInsertNodeBefore() 
    {
        # Arrange:
        $attr = $this->element->attributes()->itemOf(0);
        $newAttr = $this->document->createAttribute('name');
        
        # Act:
        $attr->insertAfter($newAttr, $attr);

        # Assert:
        $this->assertEquals(2, $attr->parentNode()->attributes()->count());
    }

    /**
     * @test
    */
    public function InsertBefore_CanInsertNodeBefore() 
    {
        # Arrange:
        $attr = $this->element->attributes()->itemOf(0);
        $newAttr = $this->document->createAttribute('name');
        
        # Act:
        $attr->insertBefore($newAttr, $attr);

        # Assert:
        $this->assertEquals(2, $attr->parentNode()->attributes()->count());
    }

    /**
     * @test
    */
    public function PrependChild_CanInsertNodeOfBeginning() 
    {
        # Arrange:
        $attr = $this->element->attributes()->itemOf(0);
        $newAttr = $this->document->createAttribute('name');
        
        # Act:
        $attr->prependChild($newAttr, $attr);

        # Assert:
        $this->assertEquals(2, $attr->parentNode()->attributes()->count());
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