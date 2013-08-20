<?php

namespace System\IO {

    /**
     * Provides the fields that represent reference points in streams for seeking.
     * @access public
     * @name SeekOrigin
     * @package System
     * @subpackage IO
     */
    final class SeekOrigin extends \System\Enum {

        private function __construct($name, $value) {
            $this->name = $name;
            $this->value = $value;
        }

        /**
         * Specifies the beginning of a stream.
         */
        public static function begin() {
            return new SeekOrigin("Begin", 0);
        }

        /**
         * 	Specifies the current position within a stream.
         */
        public static function current() {
            return new SeekOrigin("Current", 1);
        }

        /**
         * Specifies the end of a stream.
         */
        public static function end() {
            return new SeekOrigin("End", 2);
        }
    }
}