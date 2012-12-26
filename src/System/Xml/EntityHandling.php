<?php

namespace System\Xml {

    use \System\Enum as Enum;

    /**
     * Specifies how the System.Xml.XmlTextReader or System.Xml.XmlValidatingReader handle entities.
     * @access public
     * @name EntityHandling
     * @package System
     * @subpackage Xml
     */
    class EntityHandling extends Enum {

        private function __construct($name, $value) {
            $this->name = $name;
            $this->value = $value;
        }

        /**
         * Expands character entities and returns general entities as System.Xml.XmlNodeType.EntityReference nodes.
         * @access public
         * @static
         * @return EntityHandling
         */
        public static function expandCharEntities() {
            return new EntityHandling("EXPAND_CHAR_ENTITIES", 0);
        }

        /**
         * Expands all entities and returns the expanded nodes.
         * @access public
         * @static
         * @return EntityHandling
         */
        public static function expandEntities() {
            return new EntityHandling("EXPAND_ENTITIES", 1);
        }
    }
}