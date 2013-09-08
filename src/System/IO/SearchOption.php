<?php

namespace System\IO
{

    use \System\Enum as Enum;

    /**
     * Specifies whether to search the current directory, or the current directory and all subdirectories.
     * @access public
     * @name SearchOption
     * @package System
     * @subpackage IO
     */
    final class SearchOption extends Enum 
    {
        private function __construct($name, $value) 
        {
            $this->name = $name;
            $this->value = $value;
        }

        /**
         * Includes the current directory and all the subdirectories in a search operation. This option includes reparse points like mounted drives and symbolic links in the search.
         * @access public
         * @return \System\SearchOption
         */
        public static function allDirectories() 
        {
            return new SearchOption("AllDirectories", 0);
        }

        /**
         * Includes only the current directory in a search.
         * @access public
         * @return \System\SearchOption
         */
        public static function topDirectoryOnly() 
        {
            return new SearchOption("TopDirectoryOnly", 0);
        }
    }
}
