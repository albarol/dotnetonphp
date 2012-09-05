<?php

/**
 * Provides read-only access to a set of prefix and namespace mappings.
 * @access public
 * @name IXmlNamespaceResolver
 * @package System
 * @subpackage Xml
 */
interface IXmlNamespaceResolver {

    /**
     * Gets a collection of defined prefix-namespace mappings that are currently in scope.
     * @access public
     * @abstract
     * @param XmlNamespaceScope $scope An System.Xml.XmlNamespaceScope value that specifies the type of namespace nodes to return.
     * @return IDictionary An System.Collections.IDictionary that contains the current in-scope namespaces.
     */
    function getNamespacesInScope(XmlNamespaceScope $scope);


    /**
     * Gets the namespace URI mapped to the specified prefix.
     * @abstract
     * @param $prefix The prefix whose namespace URI you wish to find.
     * @return string The namespace URI that is mapped to the prefix; null if the prefix is not mapped to a namespace URI.
     */
    function lookupNamespace($prefix);



    /**
     * Gets the prefix that is mapped to the specified namespace URI.
     * @abstract
     * @param $namespaceName The namespace URI whose prefix you wish to find.
     * @return string The prefix that is mapped to the namespace URI; null if the namespace URI is not mapped to a prefix.
     */
    function lookupPrefix($namespaceName);

}
?>
