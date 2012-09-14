<?php

namespace System\IO {

    use \System\Enum as Enum;

    /**
     * Defines constants for read, write, or read/write access to a file.
     * @name FileAccess
     * @access public
     * @package System
     * @subpackage IO
     */
    final class FileAccess extends Enum {
        
        private function __construct($name, $value) {
            $this->name = $name;
            $this->value = $value;
        }

        /**
         * Read access to the file. Data can be read from the file. Combine with Write for read/write access.
         */
        public static function read() {
            return new FileAccess("READ", 1);
        }

        /**
         * Write access to the file. Data can be written to the file. Combine with Read for read/write access.
         */
        public static function write() {
            return new FileAccess("WRITE", 2);
        }

        /**
         * Read and write access to the file. Data can be written to and read from the file. 
         */
        public static function readWrite() {
            return new FileAccess("READ_WRITE", 3);
        }
    }
}