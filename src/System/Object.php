<?php

namespace System {

    /**
     * Supports all classes in the .NET Framework class hierarchy and provides low-level services to derived classes. This is the ultimate base class of all classes in the .NET Framework; it is the root of the type hierarchy.
     * @access public
     * @package System
     * @name Object
     */
    class Object {

        protected $properties = array();


        /**
         * Determines whether the specified System.Object is equal to the current System.Object.
         * @access public
         * @param Object $obj The System.Object to compare with the current System.Object.
         * @return Boolean true if the specified System.Object is equal to the current System.Object; otherwise, false.
         */
        public function equals($obj) {
            if($this == $obj && get_class($this) == get_class($obj)) return true;
            return false;
        }

        /**
         * Serves as a hash function for a particular type.
         * @access public
         * @return Int32 A hash code for the current System.Object.
         */
        public function getHashCode() {
            return floor((127 * rand(1, 20)) / (2 * rand(1, 5)));
        }

        /**
         * Gets the System.Type of the current instance.
         * @return The System.Type instance that represents the exact runtime type of the current instance.
         */
        public function getType() {
            return null;
        }


        /**
         * Creates a shallow copy of the current System.Object.
         * @access protected
         * @return Object A shallow copy of the current System.Object.
         */
        protected function memberwiseClone() {
            return clone $this;
        }

        /**
         * Returns a System.String that represents the current System.Object.
         * @access public
         * @return String A System.String that represents the current System.Object.
         */
        public function toString() {
            return get_class($this);
        }

        public function  __get($property) {
            if(array_key_exists($property, $this->properties)) 
                return $this->properties[$property]['value'];
            return null;
        }

        public function  __set($property, $value) {
            if(array_key_exists($property, $this->properties) && !$this->properties[$property]['readOnly'])
                $this->properties[$property]['value'] = $value;
        }
    }
}