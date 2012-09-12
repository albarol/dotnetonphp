<?php

namespace System\Xml {

    use \System\Xml\XmlNode as XmlNode;    

    /**
     * Represents an entity declaration, such as <!ENTITY... >.
     * @access public
     * @name XmlEntity
     * @package System
     * @subpackage Xml
     */
    class XmlEntity extends XmlNode {

        /**
         * Gets the name of the optional NDATA attribute on the entity declaration.
         * @access public
         * @return string The name of the NDATA attribute. If there is no NDATA, null is returned.
         */
        public function notationName() {

        }

        /**
         * Gets the value of the public identifier on the entity declaration.
         * @access public
         * @return string The public identifier on the entity. If there is no public identifier, null is returned.
         */
        public function publicId() {

        }

        /**
         * Gets the value of the system identifier on the entity declaration.
         * @access public
         * @return string The system identifier on the entity. If there is no system identifier, null is returned.
         */
        public function systemId() {
            
        }
    }
}