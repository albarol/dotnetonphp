<?php

namespace System\IO {

    use \System\Enum as Enum;

    /**
     * Provides attributes for files and directories.
     * @access public
     * @name FileAttributes
     * @package System
     * @subpackage IO
     */
    class FileAttributes extends Enum {

        private function __construct($name, $value) {
            $this->name = $name;
            $this->value = $value;
        }


        /**
         * The file's archive status. Applications use this attribute to mark files for backup or removal.
         */
        public static function archive() {
            return new FileAttributes("ARCHIVE", 32);
        }

        /**
         * The file is compressed.
         */
        public static function compressed() {
            return new FileAttributes("COMPRESSED", 2048);
        }

        /**
         * Reserved for future use.
         */
        public static function device() {
            return new FileAttributes("DEVICE", 64);
        }
        
        /**
         * The file is a directory.
         */
        public static function directory() {
            return new FileAttributes("DIRECTORY", 16);
        }
        
        /**
         * The file or directory is encrypted. For a file, this means that all data in the file is encrypted. For a directory, this means that encryption is the default for newly created files and directories.
         */
        public static function encrypted() {
            return new FileAttributes("ENCRYPTED", 16384);
        }
        
        /**
         * The file is hidden, and thus is not included in an ordinary directory listing.
         */
        public static function hidden() {
            return new FileAttributes("HIDDEN", 2);
        }
        
        /**
         * The file is normal and has no other attributes set. This attribute is valid only if used alone.
         */
        public static function normal() {
            return new FileAttributes("NORMAL", 128);
        }
        
        /**
         * The file will not be indexed by the operating system's content indexing service.
         */
        public static function notContentIndexed() {
            return new FileAttributes("NOT_CONTENT_INDEXED", 8192);
        }
        
        /**
         * The file is offline. The data of the file is not immediately available.
         */
        public static function offline() {
            return new FileAttributes("OFFLINE", 4096);
        }
        
        /**
         * The file is read-only.
         */
        public static function readOnly() {
            return new FileAttributes("READ_ONLY", 1);
        }
        
        /**
         * The file contains a reparse point, which is a block of user-defined data associated with a file or a directory.
         */
        public static function reparsePoint() {
            return new FileAttributes("REPARSE_POINT", 1024);
        }
        
        /**
         * The file is a sparse file. Sparse files are typically large files whose data are mostly zeros.
         */
        public static function sparseFile() {
            return new FileAttributes("SPARSE_FILE", 512);
        }
        
        /**
         * The file is a system file. The file is part of the operating system or is used exclusively by the operating system.
         */
        public static function system() {
            return new FileAttributes("SYSTEM", 4);
        }
        
        /**
         * The file is temporary. File systems attempt to keep all of the data in memory for quicker access rather than flushing the data back to mass storage. A temporary file should be deleted by the application as soon as it is no longer needed.
         */
        public static function temporary() {
            return new FileAttributes("TEMPORARY", 256);
        }
    }
}
