<?php

namespace System\Xml\XPath;


/**
 * Provides an accessor to the XPathNavigator class.
 * @access public
 * @name IXPathNavigable
 * @package System
 * @subpackage Xml\XPath
 */
interface IXPathNavigable {

    /**
     * The IXPathNavigable type exposes the following members.
     * @abstract
     * @access public
     * @return IXPathNavigable Returns a new XPathNavigator object.
     */
    function createNavigator();

}
