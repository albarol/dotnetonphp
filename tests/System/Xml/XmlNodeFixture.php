<?php

require_once(dirname(__FILE__) . '/../../../src/Autoloader.php');

class XmlNodeFixture extends PHPUnit_Framework_TestCase {

	    public function test_Attributes_GetAttributesFromXmlNode() {
	    	# Arrange:
	    	$node = new \System\Xml\XmlNode();
	    	
			# Act:
	    	$attributes = $node->attributes();

	    	# Assert:
	    	$this->assertEquals($attributes->lenght(), 2);
	    }


}
?>