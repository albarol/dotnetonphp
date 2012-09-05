<?php

/**
 * Represents an element.
 * @access public
 * @name XmlElement
 * @package System
 * @subpackage Xml
 */
class XmlElement extends XmlLinkedNode {

    /**
     * Creates a new object that is a copy of the current instance.
     * @access public
     * @return Object A new object that is a copy of this instance.
     */
    public function cloneObject() {
        // TODO: Implement cloneObject() method.
    }

    /**
     * Returns an enumerator that iterates through a collection.
     * @access public
     * @return IEnumerator An System.Collections.IEnumerator object that can be used to iterate through the collection.
     */
    public function getEnumerator() {
        // TODO: Implement getEnumerator() method.
    }

    /**
     * The IXPathNavigable type exposes the following members.
     * @access public
     * @return IXPathNavigable Returns a new XPathNavigator object.
     */
    public function createNavigator() {
        // TODO: Implement createNavigator() method.
    }

    /**
     * When overridden in a derived class, creates a duplicate of the node.
     * @access public
     * @throws InvalidOperationException
     * @param $deep true to recursively clone the subtree under the specified node; false to clone only the node itself.
     * @return XmlNode The cloned node.
     */
    public function cloneNode($deep) {
        // TODO: Implement cloneNode() method.
    }

    /**
     * Gets all the child nodes of the node.
     * @access public
     * @return XmlNodeList
     */
    public function childNodes()
    {
        // TODO: Implement childNodes() method.
    }
}
