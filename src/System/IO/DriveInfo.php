<?php

namespace System\IO {

    use \System\IO\DriveInfo as DriveInfo;

    /**
     * Provides access to information on a drive.
     * @access public
     * @name DriverInfo
     * @package System
     * @subpackage IO
     */
    final class DriveInfo {

        private $directoryRoot;

        /**
         * Provides access to information on the specified drive.
         * @access public
         */
        public function __construct() {
             $directoryInfo = new DirectoryInfo(getcwd());
             $this->directoryRoot = $directoryInfo->root();
        }

        /**
         * Indicates the amount of available free space on a drive.
         * @access public
         * @return float The amount of free space available on the drive, in bytes.
         */
        public function availableFreeSpace() {
            return disk_free_space($this->directoryRoot->name());
        }


        /**
         * Gets the name of the file system, such as NTFS or FAT32.
         * @return string
         */
        public function driveFormat() {
            return PHP_OS;
        }


        /**
         * Gets the root directory of a drive.
         * @access public
         * @return DirectoryInfo A DirectoryInfo object that contains the root directory of the drive.
         */
        public function rootDirectory() {
            return $this->directoryRoot;
        }

        /**
         * Gets the total size of storage space on a drive.
         * @access public
         * @return float The total size of the drive, in bytes.
         */
        public function totalSize() {
            return disk_total_space($this->directoryRoot->name());
        }

    }
}