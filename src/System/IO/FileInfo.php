<?php

namespace System\IO {

    use \System\ArgumentException as ArgumentException;
    use \System\ArgumentNullException as ArgumentNullException;

    use \System\IO\DirectoryInfo as DirectoryInfo;
    use \System\IO\FileAccess as FileAccess;
    use \System\IO\FileMode as FileMode;
    use \System\IO\FileNotFoundException as FileNotFoundException;
    use \System\IO\FileStream as FileStream;
    use \System\IO\FileSystemInfo as FileSystemInfo;
    use \System\IO\StreamReader as StreamReader;
    use \System\IO\StreamWriter as StreamWriter;

    /**
     * Provides instance methods for the creation, copying, deletion, moving, and opening of files, and aids in the creation of System.IO.FileStream objects. This class cannot be inherited.
     * @access public
     * @name FileInfo
     * @package System
     * @subpackage IO
     */
    class FileInfo extends FileSystemInfo {

        private $directory;

        /**
         * Initializes a new instance of the System.IO.FileInfo class, which acts as a wrapper for a file path.
         * @access public
         * @throws \System\ArgumentNullException fileName is null.
         * @throws \System\Security\SecurityException The caller does not have the required permission.
         * @throws \System\ArgumentException The file name is empty, contains only white spaces, or contains invalid characters.
         * @throws \System\UnauthorizedAccessException Access to fileName is denied.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length. For example, on Windows-based platforms, paths must be less than 248 characters, and file names must be less than 260 characters.
         * @param string $fileName The fully qualified name of the new file, or the relative file name.
         */
        public function __construct($fileName)
        {
            $this->validateFileName($fileName);
            $this->setPropertiesToFile($fileName);
            $this->directory = new DirectoryInfo($this->infos["directoryName"]);
        }



        /**
         * Creates a System.IO.StreamWriter that appends text to the file represented by this instance of the System.IO.FileInfo.
         * @access public
         * @return \System\IO\StreamWriter
         */
        public function appendText()
        {
            return new StreamWriter($this->fullName());
        }

        /**
         * Copies an existing file to a new file.
         *
         * @access public
         * @throws \System\ArgumentException $destFileName is empty, contains only white spaces, or contains invalid characters.
         * @throws \System\IO\IOException An error occurs, or the destination file already exists and overwrite is false.
         * @throws \System\Security\SecurityException The caller does not have the required permission.
         * @throws \System\ArgumentNullException destFileName is null.
         * @throws \System\IO\DirectoryNotFoundException The directory specified in destFileName does not exists.
         * @throws \System\UnauthorizedAccessException A directory path is passed in, or the file is being moved to a different drive.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length.For example, on Windows-based platforms, paths must be less than 248 characters, and file names must be less than 260 characters.
         * @throws \System\NotSupportedException destFilename contains a colon (:) in the middle of the string.
         * @param string $destFileName The name of the new file to copy to.
         * @param bool $overwrite true to allow an existing file to be overwritten; otherwise, false.
         * @return \System\FileInfo A new file, or an overwrite of an existing file if overwrite is true. If the file exists and overwrite is false, an IOException is thrown.
         */
        public function copyTo($destFileName, $overwrite=false) {
            $this->validateFileName($destFileName);
            $newFile = $this->getRealPath($destFileName);
            if(!$this->fileCanBeCreated($newFile, $overwrite))
                throw new IOException("destFileName exists and overwrite is false.");
            copy($this->fullName(), $newFile);
            return new FileInfo($newFile);
        }

        /**
         * Verify if file can be created
         * @param $newFile
         * @param bool $overwrite
         * @return bool
         */
        private function fileCanBeCreated($newFile, $overwrite=true) {
            return (file_exists($newFile) && $overwrite) || !file_exists($newFile);
        }

        /**
         * Get Path of fileName
         * @param $destFileName
         * @return string
         */
        private function getRealPath($destFileName)
        {
            return strpos($destFileName, Path::DirectorySeparatorChar) === false ?  $this->directoryName() . Path::DirectorySeparatorChar . $destFileName : $destFileName;
        }

        /**
         * Creates a file.
         * @access public
         * @return FileStream A new file.
         */
        public function create()
        {
            return new FileStream($this->fullName(), FileMode::openOrCreate());
        }

        /**
         * Creates a StreamWriter that writes a new text file.
         * @access public
         * @return StreamWriter A new StreamWriter.
         */
        public function createText()
        {
            return new StreamWriter($this->fullName());
        }

        /**
         * Decrypts a file that was encrypted by the current account using the Encrypt method.
         * @access public
         * @return void
         */
        public function decrypt()
        {
            //TODO: Implement decrypt method
        }

        /**
         * Permanently deletes a file.
         * @access public
         * @return void
         */
        public function delete()
        {
            if($this->exists())
            {
                unlink($this->fullName());
            }
        }

        /**
         * Gets an instance of the parent directory.
         * @access public
         * @return \System\IO\DirectoryInfo A DirectoryInfo object representing the parent directory of this file.
         */
        public function directory()
        {
            return $this->directory;
        }

        /**
         * Gets a string representing the directory's full path.
         * @access public
         * @return string A string representing the directory's full path.
         */
        public function directoryName()
        {
            return $this->directory->fullName();
        }

        /**
         * Encrypts a file so that only the account used to encrypt the file can decrypt it.
         * @access public
         * @return void
         */
        public function encrypt()
        {
            //TODO: Implement encrypt method
        }

        public function fullName()
        {
            return $this->infos["fullName"];
        }

        /**
         * Gets a FileSecurity object that encapsulates the access control list (ACL) entries for the file described by the current FileInfo object.
         * @access public
         * @param AccessControlSections $includeSections
         * @return FileSecurity A FileSecurity object that encapsulates the access control rules for the current file.
         */
        public function getAccessControl($includeSections){
            //TODO: Implement get Access Control method
        }

        /**
         * Gets or sets a value that determines if the current file is read only.
         * @access public
         * @param bool $readOnly
         * @return bool
         */
        public function isReadOnly(bool $readOnly=null) {
           //TODO: Implement filePermission
           return !is_writable($this->fullName());
        }

        /**
         * Moves a specified file to a new location, providing the option to specify a new file name.
         * @access public
         * @throws IOException
         * @param string $destFileName The path to move the file to, which can specify a different file name.
         * @return void
         */
        public function moveTo($destFileName) {
            $newFile = $this->getRealPath($destFileName);
            if(file_exists($newFile)) throw new IOException("An I/O error occurs, such as the destination file already exists or the destination device is not ready.");
            $this->copyTo($newFile, false);
            $this->delete();
        }

        /**
         * Opens a file in the specified mode.
         * @access public
         * @param string $mode A FileMode constant specifying the mode (for example, Open or Append) in which to open the file.
         * @param string $access A FileAccess constant specifying whether to open the file with Read, Write, or ReadWrite file access.
         * @param string $share A FileShare constant specifying the type of access other FileStream objects have to this file.
         * @return FileStream A file opened in the specified mode, with read/write access and unshared.
         */
        public function open($mode=null, $access=null, $share=null) {
            return new FileStream($this->fullName());
        }

        /**
         * Creates a read-only FileStream.
         * @access public
         * @return FileStream A new read-only FileStream object.
         */
        public function openRead() {
            return $this->open();
        }

        /**
         * Creates a StreamReader with UTF8 encoding that reads from an existing text file.
         * @access public
         * @return StreamReader A new StreamReader with UTF8 encoding.
         */
        public function openText() {
            return new StreamReader($this->fullName());
        }

        /**
         * Creates a write-only FileStream.
         * @access public
         * @return FileStream A write-only unshared FileStream object for a new or existing file.
         */
        public function openWrite() {
            return new FileStream($this->fullName());
        }

        /**
         * Gets the size, in bytes, of the current file.
         * @access public
         * @return int
         */
        public function length() {
            return filesize($this->fullName());
        }

        public function name() {
            return $this->info["name"].".".$this->extension();
        }


        /**
         * Replaces the contents of a specified file with the file described by the current FileInfo object, deleting the original file, and creating a backup of the replaced file.
         * @access public
         * @param $destinationFileName The name of a file to replace with the current file.
         * @param $destinationBackupFileName The name of a file with which to create a backup of the file described by the destFileName parameter.
         * @param bool $ignoreMetadataErrors true to ignore merge errors (such as attributes and ACLs) from the replaced file to the replacement file; otherwise false.
         * @return FileInfo A FileInfo object that encapsulates information about the file described by the destFileName parameter.
         */
        public function replace($destinationFileName, $destinationBackupFileName, $ignoreMetadataErrors=false) {
            $this->copyTo($destinationFileName);
            $this->copyTo($destinationBackupFileName);
            $this->delete();
        }


        /**
         * A FileSecurity object that describes an access control list (ACL) entry to apply to the current file.
         * @access public
         * @param FileSecurity $fileSecurity A System.Security.AccessControl.FileSecurity object that describes an access control list (ACL) entry to apply to the current file.
         * @return void
         */
        public function setAccessControl(FileSecurity $fileSecurity){
            //TODO: implement setAccessControl
        }

        /**
         * Method to validate if file is valid
         * @throws \System\ArgumentException
         * @throws \System\ArgumentNullException
         * @throws \System\IO\PathTooLongException
         * @param $fileName
         * @return void
         */
        private function validateFileName($file_name)
        {
            if (is_null($file_name))
            {
                throw new ArgumentNullException("fileName is null");
            }

            if (strlen($file_name) == 0)
            {
                throw new ArgumentException("The file name is empty, contains only white spaces, or contains invalid characters.");
            }

            if (strlen($file_name) > 248)
            {
                throw new PathTooLongException("The specified path, file name, or both exceed the system-defined maximum length. For example, on Windows-based platforms, paths must be less than 248 characters, and file names must be less than 260 characters.");
            }
        }

        private function assertFileExists($path) {
            if (!file_exists($path)) {
                throw new FileNotFoundException("");
            }
        }
    }
}