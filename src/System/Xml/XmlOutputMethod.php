<?php

namespace System\Xml {

    use \System\Enum as Enum;

    /**
     * Specifies the method used to serialize the System.Xml.XmlWriter output.
     * @access public
     * @name XmlOutputMethod
     * @package System
     * @subpackage Xml
     */
    class XmlOutputMethod extends Enum {

        private function __construct($name, $value) {
            $this->name = $name;
            $this->value = $value;
        }

        /**
         * Use the XSLT rules to choose between the System.Xml.XmlOutputMethod.Xml and System.Xml.XmlOutputMethod.Html output methods at runtime.
         * @access public
         * @static
         * @return XmlOutputMethod
         */
        public static function autoDetect() {
            return new XmlOutputMethod("AUTO_DETECT", 3);
        }


        /**
         * Serialize according to the HTML rules specified by XSLT.
         * @access public
         * @static
         * @return XmlOutputMethod
         */
        public static function html() {
            return new XmlOutputMethod("HTML", 1);
        }

        /**
         * Serialize text blocks only.
         * @access public
         * @static
         * @return XmlOutputMethod
         */
        public static function text() {
            return new XmlOutputMethod("AUTO_DETECT", 2);
        }

        /**
         * Serialize according to the XML 1.0 rules.
         * @access public
         * @static
         * @return XmlOutputMethod
         */
        public static function xml() {
            return new XmlOutputMethod("AUTO_DETECT", 0);
        }
    }
}