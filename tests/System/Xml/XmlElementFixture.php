<?php

require_once(dirname(__FILE__) . '/../../../src/Autoloader.php');

use \System\Xml\XmlDocument as XmlDocument;
use \System\Xml\XmlElement as XmlElement;


class XmlElementFixture extends PHPUnit_Framework_TestCase {

	private $dom;

	public function setUp() {
		$this->dom = new \DOMDocument();
		$this->dom->preserveWhiteSpace = false;
		$this->dom->loadXml("<books xmlns:b='http://www.books.com'>
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


    public function test_AppendChild_ThrowsExceptionWhenNewChildIsAncestor() {
        $this->markTestIncomplete('NotImplemented');
    }

    public function test_AppendChild_ThrowsExceptionWhenNodeIsReadOnly() {
        $this->markTestIncomplete('NotImplemented');
    }

    public function test_AppendChild_CanAppendChild() {
        $this->markTestIncomplete('NotImplemented');
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

    public function test_InnerXml_CanGetInnerXml() {
    	# Arrange:
    	$first_book = $this->dom->getElementsByTagName('book')->item(0);
    	$expected = "<author>Jack Herrington</author><title>PHP Hacks</title><publisher>O'Reilly</publisher>";
    	    	
    	# Act:
    	$element = new XmlElement($first_book);

    	# Assert:
    	$this->assertEquals($expected, $element->innerXml());
    }

    public function test_Item_CanGetFirstElementByName() {
        # Arrange:
        $first_book = $this->dom->getElementsByTagName('book')->item(0);
        $element = new XmlElement($first_book);
                
        # Act:
        $node = $element->item('author');

        # Assert:
        $this->assertEquals('Jack Herrington', $node->value());
    }

    public function test_Item_CanGetElementByName() {
        # Arrange:
        $first_book = $this->dom->getElementsByTagName('book')->item(0);
        $element = new XmlElement($first_book);
                
        # Act:
        $node = $element->item('news');

        # Assert:
        $this->assertEquals(null, $node);
    }

    public function test_LastChild_CanGetFirstChild() {
        # Arrange:
        $first_book = $this->dom->getElementsByTagName('book')->item(0);
        $element = new XmlElement($first_book);
                
        # Act:
        $node = $element->lastChild();

        # Assert:
        $this->assertEquals("O'Reilly", $node->value()); 
    }

    public function test_LocalName_CanGetLocalName() {
        # Arrange:
        $first_book = $this->dom->getElementsByTagName('book')->item(0);
                        
        # Act:
        $element = new XmlElement($first_book);

        # Assert:
        $this->assertEquals("book", $element->localName());
    }

    public function test_NamespaceURI_CanGetNamespaceURI() {
        # Arrange:
        $first_book = $this->dom->getElementsByTagName('book')->item(0);
                        
        # Act:
        $element = new XmlElement($first_book);

        # Assert:
        $this->assertEquals("http://www.books.com", $element->namespaceURI());
    }

    public function test_NextSibling_CanGetNextSibling() {
        # Arrange:
        $first_book = $this->dom->getElementsByTagName('book')->item(0);
        $element = new XmlElement($first_book);
        $expected = "<author>Jack Herrington</author><title>Podcasting Hacks</title><publisher>O'Reilly</publisher>";
                        
        # Act:
        $next_sibling = $element->nextSibling();

        # Assert:
        $this->assertEquals($expected, $next_sibling->innerXml());
    }


    public function test_NodeType_CanGetNodeType() {
        # Arrange:
        $first_book = $this->dom->getElementsByTagName('book')->item(0);
                        
        # Act:
        $element = new XmlElement($first_book);

        # Assert:
        $this->assertEquals(XML_ELEMENT_NODE, $element->nodeType());
    }

    public function test_OuterXml_CanGetOuterXml() {
        # Arrange:
        $first_book = $this->dom->getElementsByTagName('book')->item(0);
        $expected = '<b:book xmlns:b="http://www.books.com" id="1"><author>Jack Herrington</author><title>PHP Hacks</title><publisher>O\'Reilly</publisher></b:book>';
                
        # Act:
        $element = new XmlElement($first_book);

        # Assert:
        $this->assertEquals($expected, $element->outerXml());
    }


    public function test_OwnerDocument_CanGetOwnerDocument() {
       $this->markTestIncomplete('need implement XmlDocument to use OwnerDocument');
    }

    public function test_ParentNode_GetParentNodeWhenIsElement() {
        # Arrange:
        $first_book = $this->dom->getElementsByTagName('book')->item(0);
                
        # Act:
        $element = new XmlElement($first_book);

        # Assert:
        $this->assertEquals('books', $element->parentNode()->name());
    }

    public function test_ParentNode_GetParentNodeWhenIsDocument() {
        $this->markTestIncomplete('need implement XmlDocument to use OwnerDocument');

        /*# Arrange:
        $books = $this->dom->getElementsByTagName('books')->item(0);
                
        # Act:
        $element = new XmlElement($books);

        # Assert:
        $this->assertEquals('books', $element->parentNode()->name());*/
    }

    public function test_Prefix_CanGetPrefix() {
        # Arrange:
        $first_book = $this->dom->getElementsByTagName('book')->item(0);
                
        # Act:
        $element = new XmlElement($first_book);

        # Assert:
        $this->assertEquals('b', $element->prefix());
    }

    public function test_PreviousSibling_CanGetPreviousSibling() {
        # Arrange:
        $first_book = $this->dom->getElementsByTagName('book')->item(1);
        $element = new XmlElement($first_book);
        $expected = "<author>Jack Herrington</author><title>PHP Hacks</title><publisher>O'Reilly</publisher>";
                        
        # Act:
        $previous_sibling = $element->previousSibling();

        # Assert:
        $this->assertEquals($expected, $previous_sibling->innerXml());
    }

    public function test_SchemaInfo_CanGetSchemaInfo() {
        $this->markTestIncomplete('Need implement XmlDocument');
    }



}