<?php

namespace System\Xml {

    use System\Enum as Enum;


    class WriteState extends Enum {

        private function __construct($name, $value) {
            $this->name = $name;
            $this->value = $value;
        }


        /**
         * Indicates that an attribute value is being written.
         * @access public
         * @static
         * @return WriteState
         */
        public static function attribute() {
            return new WriteState("ATTRIBUTE", 3);
        }

        /**
         * Indicates that the System.Xml.XmlWriter.Close method has been called.
         * @access public
         * @static
         * @return WriteState
         */
        public static function closed() {
            return new WriteState("CLOSED", 5);
        }

        /**
         * Indicates that element content is being written.
         * @access public
         * @static
         * @return WriteState
         */
        public static function content() {
            return new WriteState("CONTENT", 4);
        }

        /**
         * Indicates that an element start tag is being written.
         * @access public
         * @static
         * @return WriteState
         */
        public static function element() {
            return new WriteState("ELEMENT", 2);
        }

        /**
         * An exception has been thrown, which has left the System.Xml.XmlWriter in an invalid state. You can call the System.Xml.XmlWriter.Close method to put the System.Xml.XmlWriter in the System.Xml.WriteState.Closed state. Any other System.Xml.XmlWriter method calls results in an System.InvalidOperationException.
         * @access public
         * @static
         * @return WriteState
         */
        public static function error() {
            return new WriteState("ERROR", 6);
        }

        /**
         * Indicates that the prolog is being written.
         * @access public
         * @static
         * @return WriteState
         */
        public static function prolog() {
            return new WriteState("PROLOG", 1);
        }

        /**
         * Indicates that a Write method has not yet been called.
         * @access public
         * @static
         * @return WriteState
         */
        public static function start() {
            return new WriteState("START", 0);
        }


    }
}