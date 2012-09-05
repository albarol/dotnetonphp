<?php

require_once(dirname(__FILE__) . '/../../../system/xml/XmlDocument.php');
require_once(dirname(__FILE__) . '/../../../system/io/FileStream.php');
require_once(dirname(__FILE__) . '/../../../system/io/StreamReader.php');
require_once(dirname(__FILE__) . '/../../../system/xml/XmlTextReader.php');
require_once(dirname(__FILE__) . '/../../../system/io/TextReader.php');

use \System\Xml\XmlDocument as XmlDocument;
use \System\IO\FileStream as FileStream;
use \System\IO\StreamReader as StreamReader;
use \System\Xml\XmlTextReader as XmlTextReader;
use \System\IO\TextReader as TextReader;


/**
 * Implement tests of XmlDocument
 */
class XmlDocumentFixture extends PHPUnit_Framework_TestCase {

    private $xml = "<book ISBN='1-861001-57-5'><title>Pride And Prejudice</title><price>19.95</price></book>";
    private $paths;

    public function setUp() {
        $this->paths = array(
            'bad-formed' => dirname(__FILE__) . "/../../resources/system.xml.document-bad-formed.xml",
            'well-formed' => dirname(__FILE__) . "/../../resources/system.xml.document-well-formed.xml",
        );
    }


    private function read($node) {
        echo var_dump($node);
        if($node->count() == 0)
            return;

        foreach($node->children() as $innerNode) {
            $this->read($innerNode);
        }

    }



    public function test_Load_FromStreamThrowsExceptionWhenXmlWasNotWellFormed() {
        $xml = simplexml_load_file($this->paths['well-formed']);
        echo var_dump($xml);
        

        /*$this->setExpectedException("System\\Xml\\XmlException");
        $stream = new FileStream($this->paths['bad-formed']);
        $xml = new XmlDocument;
        $xml->load($stream);*/
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
    }


    public function test_LoadXml_ThrowsExceptionWhenXmlWasNotWellFormed() {
        $this->setExpectedException("System\\Xml\\XmlException");
        $xml = new XmlDocument();
        $xml->loadXml("<books><book></books>");
    }

    public function test_LoadXml_CanLoadXmlFromString() {
        $xml = new XmlDocument();
        $xml->loadXml($this->xml);
        $this->assertEquals(1, $xml->childNodes()->count());
    }

    

}
?>
