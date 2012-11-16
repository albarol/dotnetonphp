<?php

namespace System\Text {

    use \System\Enum as Enum;

    /**
     * Defines the type of normalization to perform.
     * @access public
     * @package System
     * @subpackage Text
     * @name NormalizationForm
     */
    class NormalizationForm extends Enum {

        private function __construct($name, $value) {
            $this->name = $name;
            $this->value = $value;
        }

        /**
         * Indicates that a Unicode string is normalized using full canonical decomposition, followed by the replacement of sequences with their primary composites, if possible. 
         * @access public
         * @return \System\Text\NormalizationForm
         */
        public static function formC() {
            return new NormalizationForm("FormC", 0);
        }

        /**
         * Indicates that a Unicode string is normalized using full canonical decomposition. 
         * @access public
         * @return \System\Text\NormalizationForm
         */
        public static function formD() {
            return new NormalizationForm("FormD", 1);
        }

        /**
         * Indicates that a Unicode string is normalized using full compatibility decomposition, followed by the replacement of sequences with their primary composites, if possible. 
         * @access public
         * @return \System\Text\NormalizationForm
         */
        public static function formKC() {
            return new NormalizationForm("FormKC", 2);
        }

        /**
         * Indicates that a Unicode string is normalized using full compatibility decomposition. 
         * @access public
         * @return \System\Text\NormalizationForm
         */
        public static function formKD() {
            return new NormalizationForm("FormKD", 3);
        }

    }
}
