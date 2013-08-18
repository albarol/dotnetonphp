<?php

namespace System\IO {


    use \System\Enum as Enum;

    /**
     * Specifies how the operating system should open a file.
     *
     * @access public
     * @name FileMode
     * @package System
     * @subpackage IO
     */
    class FileMode extends Enum {

        private function __construct($name, $value) {
            $this->name = $name;
            $this->value = $value;
        }

        /**
         * Opens the file if it exists and seeks to the end of the file, or creates a new file. FileMode.Append can only be used in conjunction with FileAccess.Write. Attempting to seek to a position before the end of the file will throw an IOException and any attempt to read fails and throws an NotSupportedException.
         */
        public static function append() {
            return new FileMode("APPEND", "a");
        }

        /**
         * Specifies that the operating system should create a new file. If the file already exists, it will be overwritten. This requires FileIOPermissionAccess.Write. System.IO.FileMode.Create is equivalent to requesting that if the file does not exist, use CreateNew; otherwise, use Truncate. If the file already exists but is a hidden file, an UnauthorizedAccessException is thrown.
         */
        public static function create() {
            return new FileMode("CREATE", "w");
        }

        /**
         * Specifies that the operating system should create a new file. This requires FileIOPermissionAccess.Write. If the file already exists, an IOException is thrown.
         */
        public static function createNew() {
            return new FileMode("CREATE_NEW", "x");
        }

        /**
         * 	Specifies that the operating system should open an existing file. The ability to open the file is dependent on the value specified by FileAccess. A System.IO.FileNotFoundException is thrown if the file does not exist.
         */
        public static function open() {
            return new FileMode("OPEN", "r");
        }

        /**
         * Specifies that the operating system should open a file if it exists; otherwise, a new file should be created. If the file is opened with FileAccess.Read, FileIOPermissionAccess.Read is required. If the file access is FileAccess.Write then FileIOPermissionAccess.Write is required. If the file is opened with FileAccess.ReadWrite, both FileIOPermissionAccess.Read and FileIOPermissionAccess.Write are required. If the file access is FileAccess.Append, then FileIOPermissionAccess.Append is required.
         */
        public static function openOrCreate() {
            return new FileMode("OPEN_OR_CREATE", "r+");
        }

        /**
         * Specifies that the operating system should open an existing file. Once opened, the file should be truncated so that its size is zero bytes. This requires FileIOPermissionAccess.Write. Attempts to read from a file opened with Truncate cause an exception.
         */
        public static function truncate() {
            return new FileMode("TRUNCATE", "w+");
        }
    }

}