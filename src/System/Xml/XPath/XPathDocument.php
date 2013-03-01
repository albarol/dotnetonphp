<?php

namespace System\Xml\XPath;

require_once("IXPathNavigable.php");

/**
 * Provides a fast, read-only, in-memory representation of an XML document by using the XPath data model.
 * @access public
 * @name XPathDocument
 * @package System
 * @subpackage Xml\XPath
 */
class XPathDocument implements  IXPathNavigable {

    public function __construct($value) {
        
    }

    private function constructFromStream($value) {

    }

    private function constructFromTextReader($value) {

    }

    private function constructFromString($value){

    }


    /**
     * The IXPathNavigable type exposes the following members.
     * @access public
     * @return IXPathNavigable Returns a new XPathNavigator object.
     */
    public function createNavigator() {
        // TODO: Implement createNavigator() method.
    }


    
}
?>