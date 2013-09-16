<?php

namespace System\IO {

    use \System\ArgumentException as ArgumentException;
    use \System\ArgumentNullException as ArgumentNullException;

    use \System\IO\FileStream as FileStream;

    /**
     * Provides static methods for the creation, copying, deletion, moving, and opening of files, and aids in the creation of System.IO.FileStream objects.
     *
     * @access public
     * @name File
     * @package System
     * @subpackage IO
     */
    final class Files {

        /**
         * Max size of path
         */
        const MAX_LENGTH = 248;

        /**
         * Opens a file, appends the specified string to the file, and then closes the file. If the file does not exist, this method creates a file, writes the specified string to the file, then closes the file.
         *
         * @access public
         * @static
         * @throws \System\ArgumentNullException path is null.
         * @throws \System\ArgumentException path is a zero-length string, contains only white space, or contains one or more invalid characters as defined by System.IO.Path.InvalidPathChars.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length. For example, on Windows-based platforms, paths must be less than 248 characters, and file names must be less than 260 characters.
         * @param string $path The file to append the specified string to.
         * @param string $contents The string to append to the file.
         * @param \System\Text\Encoding $encoding The character encoding to use.
         * @return void
         */
        public static function appendAllText($path, $contents, $encoding=null) {

            self::assertNullArgument($path);
            self::assertPathName($path);

            if(strlen($path) == 0) {
                throw new ArgumentException("path is a zero-length string, contains only white space, or contains one or more invalid characters as defined by System.IO.Path.InvalidPathChars.");
            }

            $writer = new StreamWriter($path);
            $writer->write($contents);
            $writer->close();
        }

        /**
         * Creates a StreamWriter that appends UTF-8 encoded text to an existing file.
         *
         * @access public
         * @static
         * @throws \System\UnauthorizedAccessException The caller does not have the required permission.
         * @throws \System\ArgumentException path is a zero-length string, contains only white space, or contains one or more invalid characters as defined by InvalidPathChars.
         * @throws \System\ArgumentNullException path is null.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length.For example, on Windows-based platforms, paths must be less than 248 characters, and file names must be less than 260 characters.
         * @throws \System\IO\DirectoryNotFoundException The specified path is invalid (for example, it is on an unmapped drive).
         * @throws \System\NotSupportedException path is in an invalid format.
         * @param string $path The path to the file to append to.
         * @return \System\IO\StreamWriter A StreamWriter that appends UTF-8 encoded text to an existing file.
         */
        public static function appendText($path) {
            return new StreamWriter($path, true);
        }

        /**
         * Creates or overwrites the specified file with the specified buffer size, file options, and file security.
         *
         * @access public
         * @static
         * @param string $path The name of the file.
         * @param int $bufferSize The number of bytes buffered for reads and writes to the file.
         * @param \System\IO\FileOptions $options One of the FileOptions values that describes how to create or overwrite the file.
         * @param \System\Security\AccessControl\FileSecurity $fileSecurity One of the FileSecurity values that determines the access control and audit security for the file.
         * @return void
         */
        public static function create($path, $bufferSize=null, $options=null, $fileSecurity=null) {
            return new FileStream($path);
        }

        /**
         * Copies an existing file to a new file. Overwriting a file of the same name is allowed.
         *
         * @access public
         * @static
         * @throws \System\UnauthorizedAccessException The caller does not have the required permission.
         * @throws \System\ArgumentException sourceFileName or destFileName is a zero-length string, contains only white space, or contains one or more invalid characters as defined by InvalidPathChars. -or- sourceFileName or destFileName specifies a directory.
         * @throws \System\IO\IOException destFileName is read-only, or destFileName exists and overwrite is false. -or- An I/O error has occurred.
         * @param string $sourceFileName The file to copy.
         * @param string $destFileName The name of the destination file. This cannot be a directory.
         * @return void
         */
        public static function copy($sourceFileName, $destFileName, $overwrite=false) {
            self::assertFileExists($sourceFileName);
            $source = new FileInfo($sourceFileName);
            $source->copyTo($destFileName, $overwrite);
        }

        /**
         * Deletes the specified file. An exception is not thrown if the specified file does not exist.
         *
         * @access public
         * @static
         * @throws \System\ArgumentException path is a zero-length string, contains only white space, or contains one or more invalid characters as defined by InvalidPathChars.
         * @throws \System\ArgumentNullException path is a null reference
         * @throws \System\IO\DirectoryNotFoundException The specified path is invalid, (for example, it is on an unmapped drive).
         * @throws \System\IO\IOException The specified file is in use.
         * @throws \System\NotSupportedException path is in an invalid format.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length. For example, on Windows-based platforms, paths must be less than 248 characters, and file names must be less than 260 characters.
         * @throws \System\UnauthorizedAccessException The caller does not have the required permission. -or- path is a directory. -or- path specified a read-only file.
         * @param string $fileName The name of the file to be deleted.
         * @return void
         */
        public static function delete($fileName) {
            self::assertFileExists($fileName);
            $fileInfo = new FileInfo($fileName);
            $fileInfo->delete();
        }

        /**
         * Determines whether the specified file exists.
         *
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
         *
         * @access public
         * @static
         * @throws \System\UnauthorizedAccessException The caller does not have the required permission.
         * @throws \System\ArgumentException path is a zero-length string, contains only white space, or contains one or more invalid characters as defined by InvalidPathChars.
         * @throws \System\ArgumentNullException path is a null reference
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length. For example, on Windows-based platforms, paths must be less than 248 characters, and file names must be less than 260 characters.
         * @throws \System\IO\IOException path was not found.
         * @throws \System\NotSupportedException path is in an invalid format.
         * @param string $path The file or directory for which to obtain creation date and time information.
         * @return \System\DateTime A DateTime structure set to the creation date and time for the specified file or directory. This value is expressed in local time.
         */
        public static function getCreationTime($path) {
            $fileInfo = new FileInfo($path);
            return $fileInfo->creationTime();
        }

        /**
         * Returns the date and time the specified file or directory was last accessed.
         *
         * @access public
         * @static
         * @throws \System\UnauthorizedAccessException The caller does not have the required permission.
         * @throws \System\ArgumentException path is a zero-length string, contains only white space, or contains one or more invalid characters as defined by InvalidPathChars.
         * @throws \System\ArgumentNullException path is a null reference
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length. For example, on Windows-based platforms, paths must be less than 248 characters, and file names must be less than 260 characters.
         * @throws \System\IO\IOException path was not found.
         * @throws \System\NotSupportedException path is in an invalid format.
         * @param string $path The file or directory for which to obtain creation date and time information.
         * @return \System\DateTime A DateTime structure set to the date and time that the specified file or directory was last accessed. This value is expressed in local time.
         */
        public static function getLastAccessTime($path) {
            $fileInfo = new FileInfo($path);
            return $fileInfo->lastAccessTime();
        }

        /**
         * Returns the date and time the specified file or directory was last written to.
         *
         * @access public
         * @static
         * @throws \System\UnauthorizedAccessException The caller does not have the required permission.
         * @throws \System\ArgumentException path is a zero-length string, contains only white space, or contains one or more invalid characters as defined by InvalidPathChars.
         * @throws \System\ArgumentNullException path is a null reference
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length. For example, on Windows-based platforms, paths must be less than 248 characters, and file names must be less than 260 characters.
         * @throws \System\IO\IOException path was not found.
         * @throws \System\NotSupportedException path is in an invalid format.
         * @param string $path The file or directory for which to obtain creation date and time information.
         * @return DateTime A System.DateTime structure set to the date and time that the specified file or directory was last written to. This value is expressed in local time.
         */
        public static function getLastWriteTime($path) {
            $fileInfo = new FileInfo($path);
            return $fileInfo->lastWriteTime();
        }

        /**
         * Moves a specified file to a new location, providing the option to specify a new file name.
         *
         * @access public
         * @static
         * @throws \System\IO\IOException The destination file already exists -or- sourceFileNameWasNotFound
         * @throws \System\ArgumentNullException sourceFileName or destFileName is null.
         * @throws \System\ArgumentException sourceFileName or destFileName is a zero-length string, contains only white space, or contains invalid characters as defined in InvalidPathChars.
         * @throws \System\UnauthorizedAccessException The caller does not have the required permission.
         * @param string $sourceFileName The name of the file to move.
         * @param string $destFileName The new path for the file.
         * @return void
         */
        public static function move($sourceFileName, $destFileName) {
            self::assertNullArgument($sourceFileName);
            self::assertNullArgument($destFileName);
            self::assertFileExists($sourceFileName);
            $fileInfo = new FileInfo($sourceFileName);
            $fileInfo->moveTo($destFileName);
        }


        /**
         * Opens a \System\IO\FileStream on the specified path, having the specified mode with read, write, or read/write access and the specified sharing option.
         *
         * @access public
         * @static
         * @throws \System\IO\IOException An I/O error occurred while opening the file.
         * @throws \System\ArgumentNullException path is null.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length.
         * @throws \System\ArgumentException path is a zero-length string, contains only white space, or contains one or more invalid characters as defined by InvalidPathChars. -or- access specified Read and mode specified Create, CreateNew, Truncate, or Append.
         * @throws \System\ArgumentOutOfRangeException mode or acces an invalid value.
         * @throws \System\IO\FileNotFoundException The file specified in path was not found.
         * @param string $path The file to open.
         * @param string $mode A System.IO.FileMode value that specifies whether a file is created if one does not exist, and determines whether the contents of existing files are retained or overwritten.
         * @param int $access A System.IO.FileAccess value that specifies the operations that can be performed on the file.
         * @return \System\IO\FileStream A System.IO.FileStream on the specified path, having the specified mode with read, write, or read/write access and the specified sharing option.
         */
        public static function open($path, $mode=null, $access=null) {

            if(is_null($mode)) {
                $mode = FileMode::open();
            }

            if(is_null($access)) {
                $access = FileAccess::read();
            }

            if (!($mode instanceof FileMode) || !($access instanceof FileAccess)) {
                throw new ArgumentOutOfRangeException("mode or acces an invalid value.");
            }

            return new FileStream($path, $mode, $access);
        }

        /**
         * Opens an existing file for reading.
         *
         * @access public
         * @static
         * @throws \System\IO\IOException An I/O error occurred while opening the file.
         * @throws \System\ArgumentNullException path is null.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length.
         * @throws \System\ArgumentException path is a zero-length string, contains only white space, or contains one or more invalid characters as defined by InvalidPathChars. -or- access specified Read and mode specified Create, CreateNew, Truncate, or Append.
         * @throws \System\ArgumentOutOfRangeException mode or acces an invalid value.
         * @throws \System\IO\FileNotFoundException The file specified in path was not found.
         * @param string $path The file to open.
         * @return \System\IO\FileStream A System.IO.FileStream on the specified path, having the specified mode with read, write, or read/write access and the specified sharing option.
         */
        public static function openRead($path) {
            return self::open($path, FileMode::open(), FileAccess::read());
        }

        /**
         * Opens an existing UTF-8 encoded text file for reading.
         *
         * @access public
         * @static
         * @throws \System\IO\IOException An I/O error occurred while opening the file.
         * @throws \System\ArgumentNullException path is null.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length.
         * @throws \System\ArgumentException path is a zero-length string, contains only white space, or contains one or more invalid characters as defined by InvalidPathChars. -or- access specified Read and mode specified Create, CreateNew, Truncate, or Append.
         * @throws \System\ArgumentOutOfRangeException mode or acces an invalid value.
         * @throws \System\IO\FileNotFoundException The file specified in path was not found.
         * @param string $path The file to be opened for reading.
         * @return \System\IO\StreamReader A System.IO.StreamReader on the specified path.
         */
        public static function openText($path) {
            return new StreamReader(new FileStream($path));
        }


        /**
         * Opens an existing file for writing.
         *
         * @access public
         * @static
         * @throws \System\UnauthorizedAccessException The caller does not have the required permission.
         * @throws \System\ArgumentException path is a zero-length string, contains only white space, or contains one or more invalid characters as defined by InvalidPathChars.
         * @throws \System\ArgumentNullException path is null.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length.
         * @throws \System\IO\FileNotFoundException The file specified in path was not found.
         * @param string $path The file to be opened for writing.
         * @return \System\IO\FileStream An unshared System.IO.FileStream object on the specified path with System.IO.FileAccess.Write access.
         */
        public static function openWrite($path) {
            return new FileStream($path, FileMode::open(), FileAccess::write());
        }


        /**
         * Opens a binary file, reads the contents of the file into a byte array, and then closes the file.
         *
         * @access public
         * @static
         * @throws \System\UnauthorizedAccessException The caller does not have the required permission.
         * @throws \System\ArgumentException path is a zero-length string, contains only white space, or contains one or more invalid characters as defined by InvalidPathChars.
         * @throws \System\ArgumentNullException path is null.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length.
         * @throws \System\IO\FileNotFoundException The file specified in path was not found.
         * @param string $path The file to open for reading.
         * @return array A byte array containing the contents of the file.
         */
        public static function readAllBytes($path) {
            $sr = new StreamReader($path);
            return $sr->readBlock();
        }


        /**
         * Opens a text file, reads all lines of the file, and then closes the file.
         *
         * @access public
         * @static
         * @throws \System\UnauthorizedAccessException The caller does not have the required permission.
         * @throws \System\ArgumentException path is a zero-length string, contains only white space, or contains one or more invalid characters as defined by InvalidPathChars.
         * @throws \System\ArgumentNullException path is null.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length.
         * @throws \System\IO\FileNotFoundException The file specified in path was not found.
         * @param $path The file to open for reading.
         * @return array A string array containing all lines of the file.
         */
        public static function readAllLines($path) {
            $sr = new StreamReader($path);
            $lines = array();

            while(!$sr->endOfStream()) {
                array_push($lines, $sr->readLine());
            }
            return $lines;
        }

        /**
         * Opens a text file, reads all lines of the file into a string, and then closes the file.
         *
         * @access public
         * @static
         * @throws \System\UnauthorizedAccessException The caller does not have the required permission.
         * @throws \System\ArgumentException path is a zero-length string, contains only white space, or contains one or more invalid characters as defined by InvalidPathChars.
         * @throws \System\ArgumentNullException path is null.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length.
         * @throws \System\IO\FileNotFoundException The file specified in path was not found.
         * @param string $path The file to open for reading.
         * @param \System\Text\Encoding The encoding applied to the contents of the file.
         * @return array A string array containing all lines of the file.
         */
        public static function readAllText($path, $encoding=null) {
            $sr = new StreamReader($path);
            return $sr->readToEnd();
        }

        /**
         * Replaces the contents of a specified file with the contents of another file, deleting the original file, and creating a backup of the replaced file.
         *
         * @access public
         * @static
         * @throws \System\ArgumentNullException The destinationFileName parameter is null.
         * @throws \System\IO\FileNotFoundException The file specified in path was not found.
         * @throws \System\IO\IOException An I/O error occured while opening then file.
         * @throws \System\UnauthorizedAccessException The caller does not have the required permission.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length.
         * @param string $sourceFileName The name of a file that replaces the file specified by destinationFileName.
         * @param string $destinationFileName The name of the file being replaced.
         * @param string $destionationBackupFileName The name of the backup file.
         * @return void
        */
        public static function replace($sourceFileName, $destinationFileName, $destinationBackupFileName) {
            self::assertFileExists($sourceFileName);

            $source = new FileInfo($sourceFileName);
            $destination = new FileInfo($destinationFileName);

            try {
                $destination->moveTo($destinationBackupFileName);
                $source->moveTo($destinationFileName);
            } catch(\Exception $e) {
                throw new IOException("An I/O error occured while opening the file.");
            }
        }

        /**
         * Applies access control list (ACL) entries described by a FileSecurity object to the specified file.
         *
         * @access public
         * @static
         * @throws \System\IO\IOException An I/O error occurred while opening the file.
         * @throws \System\SystemException  The file could not be found.
         * @throws \System\UnauthorizedAccessException The path parameter specified a file that is read-only. -or- The caller does not have the required permission.
         * @param string A file to add or remove access control list (ACL) entries from.
         * @param \System\Security\AccessControl\FileSecurity A FileSecurity object that describes an ACL entry to apply to the file described by the path parameter.
         * @return void
        */
        public static function setAccessControl($path, \System\Security\AccessControl\FileSecurity $fileSecurity) { }

        /**
         * Sets the specified FileAttributes of the file on the specified path.
         *
         * @access public
         * @static
         * @throws \System\ArgumentException
         * @throws \System\IO\PathTooLongException
         * @throws \System\IO\FileNotFoundException
         * @throws \System\UnauthorizedAccessException
         * @param string $path The path to file.
         * @param \System\IO\FileAttributes The desired FileAttributes, such as Hidden, ReadOnly, Normal and Archive.
         * @return void
        */
        public static function setAttributes($path, \System\IO\FileAttributes $FileAttributes) {}

        /**
         * Sets the date and time the specified file was last accessed.
         *
         * @access public
         * @static
         * @throws \System\IO\FileNotFoundException The specified path was not found.
         * @throws \System\ArgumentException path is a zero-length string, contains only white space.
         * @throws \System\ArgumentNullException path is null.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length.
         * @throws \System\IO\IOException An I/O error occurred while performing the operation.
         * @throws \System\UnauthorizedAccessException The caller does not have the required permission.
         * @param string $path The file for which to set the creation date and time information.
         * @param \System\DateTime $lastAccessTime A DateTime containing the value to set for the last access date and time of path. This value is expressed in local time.
         * @return void
        */
        public static function setLastAccessTime($path, \System\DateTime $lastAccessTime) {
            self::assertNullArgument($path);
            self::assertEmpty($path);
            self::assertPathName($path);
            self::assertFileExists($path);


            try {
                $file = new FileInfo($path);
                $file->lastAccessTime($lastAccessTime);
            }
            catch (\Exception $e) {
                throw new IOException("An I/O error ocurred while performing the operation.");
            }
        }

        /**
         * Sets the date and time, in coordinated universal time (UTC), that the file was viewed.
         *
         * @access public
         * @static
         * @throws \System\IO\FileNotFoundException The specified path was not found.
         * @throws \System\ArgumentException path is a zero-length string, contains only white space.
         * @throws \System\ArgumentNullException path is null.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length.
         * @throws \System\IO\IOException An I/O error occurred while performing the operation.
         * @throws \System\UnauthorizedAccessException The caller does not have the required permission.
         * @param string $path The file for which to set the creation date and time information.
         * @param \System\DateTime $creationTime A DateTime containing the value to set for the creation date and time of path. This value is expressed in (UTC) time.
         * @return void
        */
        // public static function setLastAccessTimeUtc($path, \System\DateTime $lastAccessTime) {
        //     self::assertNullArgument($path);
        //     self::assertEmpty($path);
        //     self::assertPathName($path);
        //     self::assertFileExists($path);

        //     try {
        //         $file = new FileInfo($path);
        //         $file->creationTime($lastAccessTime->);
        //     }
        //     catch (\Exception $e) {
        //         throw new IOException("An I/O error ocurred while performing the operation.");
        //     }
        // }



        public static function write($fileName) {
            return new StreamWriter($fileName);
        }

        private static function assertNullArgument($path) {
            if(is_null($path)) {
                throw new ArgumentNullException("path is null.");
            }
        }

        private static function assertEmpty($path) {
            if (empty($path)) {
                throw new ArgumentException("path is a zero-length string, contains only white space.");
            }
        }

        private static function assertPathName($path) {
            if(strlen($path) > self::MAX_LENGTH) {
                throw new PathTooLongException("The specified path, file name, or both exceed the system-defined maximum length. For example, on Windows-based platforms, paths must be less than 248 characters, and file names must be less than 260 characters.");
            }
        }

        private static function assertFileExists($path) {
            if(!file_exists($path)) {
                throw new FileNotFoundException("The file specified in path was not found.");
            }
        }


    }
}
