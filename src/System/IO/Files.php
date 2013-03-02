<?php

namespace System\IO {

use \System\ArgumentNullException as ArgumentNullException;

use \System\IO\FileInfo as FileInfo;
use \System\IO\StreamReader as StreamReader;
use \System\IO\StreamWriter as StreamWriter;

    /**
     * Provides static methods for the creation, copying, deletion, moving, and opening of files, and aids in the creation of System.IO.FileStream objects.
     * @name File
     * @package System
     * @subpackage IO
     * @access public
     */
    final class Files {

        /**
         * Max size of path
         */
        const MAX_LENGTH = 248;

        /**
         * Opens a file, appends the specified string to the file, and then closes the file. If the file does not exist, this method creates a file, writes the specified string to the file, then closes the file.
         * @access public
         * @static
         * @throws ArgumentNullException|ArgumentException|PathTooLongException
         * @param string $path The file to append the specified string to.
         * @param string $contents The string to append to the file.
         * @param Encoding $encoding The character encoding to use.
         * @return void
         */
        public static function appendAllText($path, $contents, $encoding=null) {
            if($path == null) throw new ArgumentNullException("path is null.");
            if(strlen($path) == 0) throw new ArgumentException("path is a zero-length string, contains only white space, or contains one or more invalid characters as defined by System.IO.Path.InvalidPathChars.");
            if(strlen($path) > self::MAX_LENGTH) throw new PathTooLongException("The specified path, file name, or both exceed the system-defined maximum length. For example, on Windows-based platforms, paths must be less than 248 characters, and file names must be less than 260 characters. ");
            $writer = new StreamWriter($path);
            $writer->write($contents);
            $writer->close();
        }

        /**
         * Creates a StreamWriter that appends UTF-8 encoded text to an existing file.
         * @access public
         * @static
         * @param string $path The path to the file to append to.
         * @return StreamWriter A StreamWriter that appends UTF-8 encoded text to an existing file. 
         */
        public static function appendText($path) {
            return new StreamWriter($path, true);
        }

        /**
         * Creates or overwrites the specified file with the specified buffer size, file options, and file security.
         * @access public
         * @static
         * @param string $path The name of the file.
         * @param int $bufferSize The number of bytes buffered for reads and writes to the file. 
         * @param string $options One of the FileOptions values that describes how to create or overwrite the file.
         * @param string $fileSecurity One of the FileSecurity values that determines the access control and audit security for the file.
         * @return void
         */
        public static function create($path, $bufferSize=null, $options=null, $fileSecurity=null) {
            return new FileStream($path);
        }

        /**
         * Copies an existing file to a new file. Overwriting a file of the same name is allowed.
         * @static
         * @throws IOException
         * @param string $sourceFileName The file to copy.
         * @param string $destFileName The name of the destination file. This cannot be a directory.
         * @return void
         */
        public static function copy($sourceFileName, $destFileName) {
            $source = new FileInfo($sourceFileName);
            $source->copyTo($destFileName, false);
        }

        /**
         * Deletes the specified file. An exception is not thrown if the specified file does not exist.
         * @static
         * @throws IOException
         * @param string $fileName The name of the file to be deleted.
         * @return void
         */
        public static function delete($fileName) {
            $fileInfo = new FileInfo($fileName);
            $fileInfo->delete();
        }

        /**
         * Determines whether the specified file exists.
         * @access public
         * @static
         * @param string $fileName The file to check.
         * @return bool true if the caller has the required permissions and path contains the name of an existing file; otherwise, false. This method also returns false if path is null, an invalid path, or a zero-length string. If the caller does not have sufficient permissions to read the specified file, no exception is thrown and the method returns false regardless of the existence of path.
         */
        public static function exists($fileName) {
            return file_exists($fileName);
        }

        /**
         * Returns the creation date and time of the specified file or directory.
         * @access public
         * @static
         * @param string $path The file or directory for which to obtain creation date and time information.
         * @return DateTime A System.DateTime structure set to the creation date and time for the specified file or directory. This value is expressed in local time.
         */
        public static function getCreationTime($path) {
            $fileInfo = new FileInfo($path);
            return $fileInfo->creationTime();
        }

        /**
         * Returns the date and time the specified file or directory was last accessed.
         * @access public
         * @static
         * @param string $path The file or directory for which to obtain access date and time information.
         * @return DateTime A System.DateTime structure set to the date and time that the specified file or directory was last accessed. This value is expressed in local time.
         */
        public static function getLastAccessTime($path) {
            $fileInfo = new FileInfo($path);
            return $fileInfo->lastAccessTime();
        }

        /**
         * Returns the date and time the specified file or directory was last written to.
         * @access public
         * @static
         * @param string $path The file or directory for which to obtain write date and time information.
         * @return DateTime A System.DateTime structure set to the date and time that the specified file or directory was last written to. This value is expressed in local time.
         */
        public static function getLastWriteTime($path) {
            $fileInfo = new FileInfo($path);
            return $fileInfo->lastWriteTime();
        }

        /**
         * Moves a specified file to a new location, providing the option to specify a new file name.
         * @access public
         * @static
         * @param string $sourceFileName The name of the file to move.
         * @param string $destFileName The new path for the file.
         * @return void
         */
        public static function move($sourceFileName, $destFileName) {
            if(is_null($destFileName)) throw new ArgumentNullException("destFileName is null.");
            $fileInfo = new FileInfo($sourceFileName);
            $fileInfo->moveTo($destFileName);
        }


        /**
         * Opens a System.IO.FileStream on the specified path, having the specified mode with read, write, or read/write access and the specified sharing option.
         * @access public
         * @static
         * @throws IOException|ArgumentNullException|ArgumentException|PathTooLongException
         * @param string $path The file to open.
         * @param string $mode A System.IO.FileMode value that specifies whether a file is created if one does not exist, and determines whether the contents of existing files are retained or overwritten.
         * @param int $access A System.IO.FileAccess value that specifies the operations that can be performed on the file.
         * @return FileStream A System.IO.FileStream on the specified path, having the specified mode with read, write, or read/write access and the specified sharing option.
         */
        public static function open($path, $mode=null, $access=null) {
            if(is_null($mode)):
                $mode = FileMode::open();
            endif;

            if(is_null($access)):
                $access = FileAccess::read();
            endif;

            self::validateOpen($path);
            return new FileStream($path, $mode, $access);
        }


        /**
         * Opens an existing file for reading.
         * @access public
         * @static
         * @throws IOException|ArgumentNullException|ArgumentException|PathTooLongException
         * @param $path
         * @return FileStream
         */
        public static function openRead($path) {
            return self::open($path);
        }

        /**
         * Opens an existing UTF-8 encoded text file for reading.
         * @access public
         * @static
         * @throws IOException|ArgumentNullException|ArgumentException|PathTooLongException
         * @param string $path The file to be opened for reading.
         * @return StreamReader A System.IO.StreamReader on the specified path.
         */
        public static function openText($path) {
            self::validateOpen($path);
            return new StreamReader($path);
        }


        /**
         * Opens an existing file for writing.
         * @access public
         * @static
         * @param $path The file to be opened for writing.
         * @return FileStream An unshared System.IO.FileStream object on the specified path with System.IO.FileAccess.Write access.
         */
        public static function openWrite($path) {
            self::validateOpen($path);
            return new FileStream($path, FileMode::openOrCreate(), FileAccess::write());
        }


        /**
         * Opens a binary file, reads the contents of the file into a byte array, and then closes the file.
         * @access public
         * @static
         * @throws ArgumentNullException|ArgumentException|PathTooLongException
         * @param $path The file to open for reading. 
         * @return array A byte array containing the contents of the file.
         */
        public static function readAllBytes($path) {
            self::validateOpen($path);
            $byteArray = array();
            $handle = fopen($path, FileMode::open());
            while (!feof($handle)) {
                $byte = fread($handle, 1);
                array_push($byteArray, $byte);
            }
            fclose($handle);
            return $byteArray;
        }


        /**
         * Opens a text file, reads all lines of the file, and then closes the file.
         * @access public
         * @static
         * @throws ArgumentNullException|ArgumentException|PathTooLongException
         * @param $path The file to open for reading.
         * @return array A string array containing all lines of the file.
         */
        public static function readAllLines($path) {
            self::validateOpen($path);
            $lines = array();
            $reader = new StreamReader($path);
            while(!$reader->endOfStream()) {
                array_push($lines, $reader->readLine());
            }
            return $lines;
        }

        private static function validateOpen($path) {
            if(is_null($path)) throw new ArgumentNullException("path is null.");
            if(strlen($path) > self::MAX_LENGTH) throw new PathTooLongException("The specified path, file name, or both exceed the system-defined maximum length. For example, on Windows-based platforms, paths must be less than 248 characters, and file names must be less than 260 characters.");
            if(!file_exists($path)) throw new FileNotFoundException("The file specified in path was not found.");
            return true;
        }

        public static function write($fileName) {
            return new StreamWriter($fileName);
        }
    }
}
