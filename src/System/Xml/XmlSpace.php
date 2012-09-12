<?php

namespace System\Xml {

    use \System\Enum as Enum;

    /**
     * Specifies the current xml:space scope.
     * @access public
     * @name XmlSpace
     * @package System
     * @subpackage Xml
     */
    class XmlSpace extends Enum {

         private function __construct($name, $value) {
            $this->name = $name;
            $this->value = $value;
         }

        /**
         * The xml:space scope equals default.
         * @access public
         * @static
         * @return XmlSpace
         */
        public static function def() {
            return new XmlSpace("DEFAULT", 1);
        }

        /**
         * No xml:space scope.
         * @access public
         * @static
         * @return XmlSpace
         */
        public static function none() {
            return new XmlSpace("NONE", 0);
        }

        /**
         * The xml:space scope equals preserve.
         * @access public
         * @static
         * @return XmlSpace
         */
        public static function preserve() {
            return new XmlSpace("PRESERVE", 2);
        }

    }
}