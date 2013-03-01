<?php

namespace System\IO;

require_once(dirname(__FILE__)."/../DateTime.php");
require_once("FileAttributes.php");
require_once("Path.php");

use \System\DateTime as DateTime;
use \System\IO\FileAttributes as FileAttributes;
use \System\IO\Path as Path;

/**
 *  Provides the base class for both system.io.FileInfo and system.io.DirectoryInfo objects.
 * @access public
 * @name FileSystemInfo
 * @package System
 * @subpackage IO
 */
abstract class FileSystemInfo {

    protected $dates = array();
    protected $attributes = "";
    protected $info = array();


    /**
     * Gets or sets the attributes for the current file or directory.
     * @access public
     * @param FileAttributes $attributes fileAttributes of the current FileSystemInfo.
     * @return FileAttributes fileAttributes of the current FileSystemInfo.
     */
    public function attributes(FileAttributes $attributes=null) {
        if($attributes != null)
            $this->attributes = $attributes;
        return $this->attributes;
    }

    /**
     * Gets the creation time of the current system.io.FileSystemInfo object.
     * @access public
     * @param \System\DateTime $creationTime The creation date and time of the current System.IO.FileSystemInfo object
     * @return \System\DateTime The creation date and time of the current System.IO.FileSystemInfo object.
     */
    public function creationTime(DateTime $creationTime=null){
        if($creationTime != null)
            $this->dates["CREATED_TIME"] = $creationTime;
        return $this->dates["CREATED_TIME"];
    }

    /**
     * Gets the creation time, in coordinated universal time (UTC), of the current file or directory.
     * @access public
     * @return \System\DateTime The creation date and time of the current System.IO.FileSystemInfo object.
     */
    public function creationTimeUtc(){
        return gmdate($this->dates["CREATED_TIME"]->toString("c"));
    }

    /**
     * Gets a value indicating whether the file or directory exists.
     * @access public
     * @return bool true if the file or directory exists; otherwise, false.
     */
    public function exists() {
        return $this->info["EXISTS"];
    }

    /**
     * Gets the string representing the extension part of the file.
     * @access public
     * @return string A string containing the system.io.FileSystemInfo extension.
     */
    public function extension() {
        return ($this->info["EXTENSION"] != null) ? $this->info["EXTENSION"] : null;
    }

    /**
     * Gets the full path of the directory or file.
     * @access public
     * @return string A string containing the full path.
     */
    public abstract function fullName();

    /**
     * Gets or sets the time the current file or directory was last accessed.
     * @access public
     * @param \System\DateTime $accessTime sets the time
     * @return \System\DateTime The time that the current file or directory was last accessed.
     */
    public function lastAccessTime(DateTime $accessTime=null) {
        if($accessTime != null)
            $this->dates["LAST_ACCESS_TIME"] = $accessTime;
        return $this->dates["LAST_ACCESS_TIME"];
    }

    /**
     * Gets the time, in coordinated universal time (UTC), that the current file or directory was last accessed.
     * @access public
     * @return \System\DateTime The time that the current file or directory was last accessed.
     */
    public function lastAccessTimeUtc() {
        return gmdate($this->dates["LAST_ACCESS_TIME"]->toString("c"));
    }

    /**
     * Gets or sets the time when the current file or directory was last written to.
     * @access public
     * @param \System\DateTime $writeTime sets the time
     * @return \System\DateTime The time the current file was last written.
     */
    public function lastWriteTime(DateTime $writeTime=null) {
         if($writeTime != null)
            $this->dates["LAST_WRITE_TIME"] = $writeTime;
        return $this->dates["LAST_WRITE_TIME"];
    }

    /**
     * Gets the time, in coordinated universal time (UTC), that the current file or directory was last written to.
     * @access public
     * @return \System\DateTime The time that the current file or directory was last written to.
     */
    public function lastWriteTimeUtc() {
        return gmdate($this->dates["LAST_WRITE_TIME"]->toString("c"));
    }

    /**
     * For files, gets the name of the file. For directories, gets the name of the last directory in the hierarchy if a hierarchy exists. Otherwise, the Name property gets the name of the directory.
     * @access public
     * @return String  A string that is the name of the parent directory, the name of the last directory in the hierarchy, or the name of a file, including the file name extension.
     */
    public abstract function name();


    /**
     * Provides information for files and directories.
     * @param string $fileSystem
     */
    protected function setPropertiesToFile($fileSystem) {
        if(!file_exists($fileSystem)) {
            $this->info["DIRECTORY_NAME"] = "";
            $this->dates["LAST_ACCESS_TIME"] = DateTime::now();
            $this->dates["LAST_WRITE_TIME"] = DateTime::now();
            $this->dates["CREATED_TIME"] = DateTime::now();
            $this->info["EXTENSION"] = end(explode(".", $fileSystem));
            $this->info["FULL_NAME"] = "";
            $this->info["NAME"] = $fileSystem;
        } else {
            $info = pathinfo($fileSystem);
            $this->info["DIRECTORY_NAME"] = realpath($info["dirname"]);
            $this->info["NAME"] = $info["filename"];
            $this->info["EXTENSION"] = isset($info["extension"]) ? $info["extension"] : "";
            $this->info["FULL_NAME"] = $this->info["DIRECTORY_NAME"].Path::AltDirectorySeparatorChar.$this->info["NAME"].".".$this->info["EXTENSION"];
            $this->dates["LAST_ACCESS_TIME"] = DateTime::parse(date("Y-m-d", fileatime($fileSystem)));
            $this->dates["LAST_WRITE_TIME"] = DateTime::parse(date("Y-m-d", filemtime($fileSystem)));
            $this->dates["CREATED_TIME"] = DateTime::parse(date("Y-m-d", filectime($fileSystem)));
        }
        $this->info["EXISTS"] = true;
        $this->attributes = FileAttributes::Archive;
    }

    protected  function setPropertiesToDirectory($fileSystem) {
        if(!file_exists($fileSystem)) {
            $this->info["DIRECTORY_NAME"] = $fileSystem;
            $this->dates["LAST_ACCESS_TIME"] = DateTime::now();
            $this->dates["LAST_WRITE_TIME"] = DateTime::now();
            $this->dates["CREATED_TIME"] = DateTime::now();
            $this->info["FULL_NAME"] = $this->info["DIRECTORY_NAME"];
            $this->info["EXISTS"] = false;
        } else {
            $info = pathinfo($fileSystem);
            $this->info["DIRECTORY_NAME"] = realpath($info["dirname"]);
            $this->dates["LAST_ACCESS_TIME"] = DateTime::parse(date("Y-m-d", fileatime($fileSystem)));
            $this->dates["LAST_WRITE_TIME"] = DateTime::parse(date("Y-m-d", filemtime($fileSystem)));
            $this->dates["CREATED_TIME"] = DateTime::parse(date("Y-m-d", filectime($fileSystem)));
            $this->info["FULL_NAME"] = $this->info["DIRECTORY_NAME"].Path::AltDirectorySeparatorChar.basename($fileSystem);
            $this->info["EXISTS"] = true;
        }
        $this->info["NAME"] = basename($this->info["FULL_NAME"]);
        $this->info["EXTENSION"] = "";
        $this->attributes = FileAttributes::Directory;
    }
}
?>
