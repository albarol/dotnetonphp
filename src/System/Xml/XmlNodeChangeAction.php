<?php

/**
 * Specifies the type of node change.
 * @access public
 * @name XmlNodeChangeAction
 * @package System
 * @subpackage Xml
 */
class XmlNodeChangeAction extends Enum {


    private function __construct($name, $value) {
        $this->Name = $name;
        $this->Value = $value;
    }

    /**
     * A node is being inserted in the tree.
     * @access public
     * @static
     * @return XmlNodeChangeAction
     */
    public static function insert() {
        return new XmlNodeChangeAction("INSERT", 0);
    }

    /**
     * A node value is being changed.
     * @access public
     * @static
     * @return XmlNodeChangeAction
     */
    public static function change() {
        return new XmlNodeChangeAction("CHANGE", 2);
    }


    /**
     * A node is being removed from the tree.
     * @access public
     * @static
     * @return XmlNodeChangeAction
     */
    public static function remove() {
        return new XmlNodeChangeAction("REMOVE", 1);
    }

}
?>
