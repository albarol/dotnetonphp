<?php

namespace System\IO {

    use \System\Enum as Enum;

    /**
     * Defines constants for drive types, including CDRom, Fixed, Network, NoRootDirectory, Ram, Removable, and Unknown.
     * @access public
     * @name DriveType
     * @package System
     * @subpackage IO
     */
    class DriveType extends Enum 
    {

        private function __construct($name, $value) 
        {
            $this->name = $name;
            $this->value = $value;
        }

        /**
         * The type of drive is unknown.
         *
         * @access public
         * @return \System\IO\DriveType
         */
        public static function unknown() 
        {
            return new DriveType("Unknown", 0);
        }

        /**
         * The drive does not have a root directory.
         *
         * @access public
         * @return \System\IO\DriveType
         */
        public static function noRootDirectory() {
            return new DriveType("NoRootDirectory", 1);
        }

        /**
         * The drive is a removable storage device, such as a floppy disk drive or a USB flash drive.
         *
         * @access public
         * @return \System\IO\DriveType
         */
        public static function removable() {
            return new DriveType("Removable", 2);
        }

        /**
         * The drive is a fixed disk.
         *
         * @access public
         * @return \System\IO\DriveType
         */
        public static function fixed() {
            return new DriveType("Fixed", 4);
        }

        /**
         * The drive is a network drive.
         *
         * @access public
         * @return \System\IO\DriveType
         */
        public static function network() {
            return new DriveType("Network", 5);
        }

        /**
         * The drive is an optical disc device, such as a CD or DVD-ROM.
         *
         * @access public
         * @return \System\IO\DriveType
         */
        public static function cdRom() {
            return new DriveType("CDRom", 6);
        }

        /**
         * The drive is a RAM disk.
         *
         * @access public
         * @return \System\IO\DriveType
         */
        public static function ram() {
            return new DriveType("Ram", 6);
        }
    }
}
