<?php

require_once(dirname(__FILE__) . '/../../../src/Autoloader.php');


use \System\Xml\XmlCDataSection as XmlCDataSection;
use \System\Xml\XmlComment as XmlComment;
use \System\Xml\XmlDocument as XmlDocument;
use \System\Xml\XmlDocumentFragment as XmlDocumentFragment;
use \System\Xml\XmlException as XmlException;

use \System\IO\FileStream as FileStream;


class XmlDocumentFixture extends PHPUnit_Framework_TestCase {

    private $xml = array(
        'well-formed' => '<?xml version="1.0"?><books xmlns:b="http://www.books.com"><book ISBN="1-861001-57-5"><title><![CDATA[Pride And Prejudice]]></title><price>19</price></book></books>',
        'bad-formed'  => "<?xml version='1.0'?><books><book></books><book>"
    );

    public function test_CreateAttribute_CanCreateAttributeByPrefix() {
        # Arrange:
        $doc = new XmlDocument;
        $expected = '<book b:id=""/>';

        # Act:
        $element = $doc->createElement('book');
        $doc->appendChild($element);
        $attr = $doc->createAttribute('id', 'http://www.books.com', 'b');
        $element->setAttributeNode($attr);

        # Assert:
        $this->assertEquals($expected, $element->outerXml());
    }

    public function test_CreateAttribute_CanCreateAttributeByName() {
        # Arrange:
        $doc = new XmlDocument;
        $expected = '<book id=""/>';

        # Act:
        $element = $doc->createElement('book');
        $doc->appendChild($element);
        $attr = $doc->createAttribute("id");
        $element->setAttributeNode($attr);

        # Assert:
        $this->assertEquals($expected, $element->outerXml());
    }

    public function test_CreateCDataSection_CanCDataSection() {
        # Arrange:
        $doc = new XmlDocument;
        $expected = '<book><![CDATA[text]]></book>';

        # Act:
        $element = $doc->createElement('book');
        $doc->appendChild($element);
        $cdata = $doc->createCDataSection('text');
        $element->appendChild($cdata);

        # Assert:
        $this->assertEquals($expected, $element->outerXml());
        $this->assertTrue($cdata instanceOf XmlCDataSection);
    }

    public function test_CreateElement_CanCreateComment() {
        # Arrange:
        $doc = new XmlDocument;
        $expected = '<book><!--Any comment--></book>';

        # Act:
        $element = $doc->createElement('book');
        $comment = $doc->createComment('Any comment');
        $element->appendChild($comment);

        # Assert:
        $this->assertEquals($expected, $element->outerXml());
        $this->assertTrue($comment instanceOf XmlComment);
    }

    public function test_CreateDocumentFragment_CanCreateDocumentFragment() {
        # Arrange:
        $doc = new XmlDocument;
        $expected = '<book/>';

        # Act:
        $frag = $doc->createDocumentFragment();
        $frag->appendChild($doc->createElement('book'));
        $doc->appendChild($frag);

        # Assert:
        $this->assertEquals($expected, $doc->outerXml());
        $this->assertTrue($frag instanceOf XmlDocumentFragment);
    }

    public function test_CreateDocumentType_CanCreateDocumentType() {
        $this->markTestIncomplete('php not support this operation');
    }

    public function test_CreateEntityReference_CanCreateEntityReference() {
        # Arrange:
        $doc = new XmlDocument;
        $expected = '<book/>';

        # Act:
        $entity = $doc->createEntityReference('a');
        echo $entity->outerXml();
        /*$frag->appendChild($doc->createElement('book'));
        $doc->appendChild($frag);

        # Assert:
        $this->assertEquals($expected, $doc->outerXml());
        $this->assertTrue($frag instanceOf XmlDocumentFragment);*/
    }

    public function test_CreateElement_CanCreateElementByPrefix() {
        # Arrange:
        $doc = new XmlDocument;
        $expected = '<b:book xmlns:b="http://www.books.com"/>';

        # Act:
        $element = $doc->createElement('book', 'http://www.books.com', 'b');

        $this->assertEquals($expected, $element->outerXml());
    }

    public function test_CreateElement_CanCreateElementByName() {
        # Arrange:
        $doc = new XmlDocument;
        $expected = '<book/>';

        # Act:
        $element = $doc->createElement('book');

        # Assert:
        $this->assertEquals($expected, $element->outerXml());
    }


    /*public function test_Load_FromStreamThrowsExceptionWhenXmlWasNotWellFormed() {
        $this->setExpectedException("\\System\\Xml\\XmlException");
        $stream = new FileStream($this->paths['bad-formed']);
        $xml = new XmlDocument;
        $xml->load($stream);
    }

    public function test_Load_FromStreamCanLoadXml() {
        $stream = new FileStream($this->paths['well-formed']);
        $xml = new XmlDocument;
        $xml->load($stream);
        $this->assertEquals(1, $xml->childNodes()->count());
    }

    public function test_Load_FromStringThrowsExceptionWhenXmlWasNotWellFormed() {
        $this->setExpectedException("System\\Xml\\XmlException");
        $xml = new XmlDocument;
        $xml->load($this->paths['bad-formed']);
    }

    public function test_Load_FromStringCanLoadXml() {
        $xml = new XmlDocument;
        $xml->load($this->paths['well-formed']);
        $this->assertEquals(1, $xml->childNodes()->count());
    }

    public function test_Load_FromTextReaderThrowsExceptionWhenXmlWasNotWellFormed() {
        $this->setExpectedException("System\\Xml\\XmlException");
        $reader = new StreamReader($this->paths['bad-formed']);
        $xml = new XmlDocument;
        $xml->load($reader);
    }

    public function test_Load_FromTextReaderCanLoadXml() {
        $reader = new StreamReader($this->paths['well-formed']);
        $xml = new XmlDocument;
        $xml->load($reader);
        $this->assertEquals(1, $xml->childNodes()->count());
    }


     public function test_Load_FromXmlReaderThrowsExceptionWhenXmlWasNotWellFormed() {
        $this->setExpectedException("System\\Xml\\XmlException");
        $reader = new XmlTextReader(new TextReader($this->paths['bad-formed']));
        $xml = new XmlDocument;
        $xml->load($reader);
    }

    public function test_Load_FromXmlReaderCanLoadXml() {
        $this->markTestIncomplete("Implement XmlReader");
        $reader = new XmlTextReader(new TextReader($this->paths['well-formed']));
        $xml = new XmlDocument;
        $xml->load($reader);
        $this->assertEquals(1, $xml->childNodes()->count());
    }*/


    public function test_LoadXml_ThrowsExceptionWhenXmlWasNotWellFormed() {
        # Arrange:
        $this->setExpectedException("\\System\\Xml\\XmlException");
        $xml = new XmlDocument();
        
        # Act:
        $xml->loadXml($this->xml['bad-formed']);
    }

    public function test_LoadXml_CanLoadXmlFromString() {
        # Arrange:
        $doc = new XmlDocument();
        
        # Act:
        $doc->loadXml($this->xml['well-formed']);
        
        # Assert:
        $this->assertEquals(1, $doc->childNodes()->count());
    }
}