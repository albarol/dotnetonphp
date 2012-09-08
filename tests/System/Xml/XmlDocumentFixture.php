<?php

require_once(dirname(__FILE__) . '/../../../src/Autoloader.php');


use \System\Xml\XmlDocument as XmlDocument;


class XmlDocumentFixture extends PHPUnit_Framework_TestCase {

    private $xml = array(
        'well-formed' => '<?xml version="1.0"?><books xmlns:html="http://www.w3.org/1999/xhtml"><book ISBN="1-861001-57-5"><title>Pride And Prejudice</title><price>19</price></book></books>',
        'bad-formed'  => "<?xml version='1.0'?><books><book></books><book>"
    );

    private function read($node) {
        #echo var_dump($node);
        if($node->count() == 0)
            return;

        foreach($node->children() as $innerNode) {
            $this->read($innerNode);
        }

    }



    /*public function test_Load_FromStreamThrowsExceptionWhenXmlWasNotWellFormed() {
        $xml = simplexml_load_file($this->xml['well-formed']);
        #echo var_dump($xml);
        

        $this->setExpectedException("System\\Xml\\XmlException");
        $stream = new FileStream($this->paths['bad-formed']);
        $xml = new XmlDocument;
        $xml->load($stream);
    }

    public function test_Load_FromStreamCanLoadXml() {
        $stream = new \System\IO\FileStream($this->paths['well-formed']);
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
        $this->setExpectedException("\\System\\Xml\\XmlException");
        $xml = new XmlDocument();
        $xml->loadXml($this->xml['bad-formed']);
    }*/

    public function test_LoadXml_CanLoadXmlFromString() {
        $doc = new XmlDocument();
        $doc->loadXml($this->xml['well-formed']);
        $this->assertEquals(1, 0);
    }

    

}
?>
