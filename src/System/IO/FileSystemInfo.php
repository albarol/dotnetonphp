<?php

namespace System\IO 
{
    use \System\DateTime as DateTime;
    use \System\IO\FileAttributes as FileAttributes;
    use \System\IO\Path as Path;

    /**
     * Provides the base class for both system.io.FileInfo and system.io.DirectoryInfo objects.
     * @access public
     * @name FileSystemInfo
     * @package System
     * @subpackage IO
     */
    abstract class FileSystemInfo 
    {
        protected $dates = array();
        protected $attributes = "";
        protected $info = array();

        /**
         * Gets or sets the attributes for the current file or directory.
         * @access public
         * @param \System\IO\FileAttributes $attributes fileAttributes of the current FileSystemInfo.
         * @return \System\IO\FileAttributes fileAttributes of the current FileSystemInfo.
         */
        public function attributes(FileAttributes $attributes=null) 
        {
            if(!is_null($attributes))
            {
                $this->attributes = $attributes;
            }
                
            return $this->attributes;
        }

        /**
         * Gets the creation time of the current system.io.FileSystemInfo object.
         * @access public
         * @param \System\DateTime $creationTime The creation date and time of the current System.IO.FileSystemInfo object
         * @return \System\DateTime The creation date and time of the current System.IO.FileSystemInfo object.
         */
        public function creationTime(DateTime $creationTime = null)
        {
            if(!is_null($creationTime))
            {
                $this->dates["created_time"] = $creationTime;
            }
            return $this->dates["created_time"];
        }

        /**
         * Gets the creation time, in coordinated universal time (UTC), of the current file or directory.
         * @access public
         * @return \System\DateTime The creation date and time of the current System.IO.FileSystemInfo object.
         */
        public function creationTimeUtc()
        {
            return $this->dates["created_time"]->utcNow();
        }

        /**
         * Gets a value indicating whether the file or directory exists.
         * @access public
         * @return bool true if the file or directory exists; otherwise, false.
         */
        public function exists() 
        {
            return $this->info["exists"];
        }

        /**
         * Gets the string representing the extension part of the file.
         * @access public
         * @return string A string containing the system.io.FileSystemInfo extension.
         */
        public function extension() 
        {
            return is_null($this->info["extension"]) ? null : $this->info["extension"];
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
        public function lastAccessTime(DateTime $accessTime = null) 
        {
            if(!is_null($accessTime))
            {
                $this->dates["last_access_time"] = $accessTime;
            }
                
            return $this->dates["last_access_time"];
        }

        /**
         * Gets the time, in coordinated universal time (UTC), that the current file or directory was last accessed.
         * @access public
         * @return \System\DateTime The time that the current file or directory was last accessed.
         */
        public function lastAccessTimeUtc() 
        {
            return $this->dates["last_access_time"]->utcNow();
        }

        /**
         * Gets or sets the time when the current file or directory was last written to.
         * @access public
         * @param \System\DateTime $writeTime sets the time
         * @return \System\DateTime The time the current file was last written.
         */
        public function lastWriteTime(DateTime $writeTime = null) 
        {
            if(!is_null($writeTime))
            {
                $this->dates["last_write_time"] = $writeTime;
            }
            
            return $this->dates["last_write_time"];
        }

        /**
         * Gets the time, in coordinated universal time (UTC), that the current file or directory was last written to.
         * @access public
         * @return \System\DateTime The time that the current file or directory was last written to.
         */
        public function lastWriteTimeUtc() 
        {
            return $this->dates["last_write_time"]->utcNow();
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
        protected function setPropertiesToFile($fileSystem) 
        {
            $info = pathinfo($fileSystem);
            $this->info["directory_name"] = realpath($info["dirname"]);
            $this->info["name"] = $info["filename"];
            $this->info["extension"] = isset($info["extension"]) ? $info["extension"] : "";
            $this->info["full_name"] = $this->info["directory_name"].Path::AltDirectorySeparatorChar.$this->info["name"].".".$this->info["extension"];
            $this->info["exists"] = file_exists($fileSystem);

            if(!file_exists($fileSystem)) 
            {            
                $this->dates["last_access_time"] = DateTime::now();
                $this->dates["last_write_time"] = DateTime::now();
                $this->dates["created_time"] = DateTime::now();
            }
            else
            {
                $this->dates["last_access_time"] = DateTime::parse(date("Y-m-d", fileatime($fileSystem)));
                $this->dates["last_write_time"] = DateTime::parse(date("Y-m-d", filemtime($fileSystem)));
                $this->dates["created_time"] = DateTime::parse(date("Y-m-d", filectime($fileSystem)));
            }

            $this->attributes = FileAttributes::archive();
        }

        protected function setPropertiesToDirectory($fileSystem) 
        {
            if(!file_exists($fileSystem)) 
            {
                $this->info["directory_name"] = $fileSystem;
                $this->dates["last_access_time"] = DateTime::now();
                $this->dates["last_write_time"] = DateTime::now();
                $this->dates["created_time"] = DateTime::now();
                $this->info["full_name"] = $this->info["directory_name"];
                $this->info["exists"] = false;
            } 
            else 
            {
                $info = pathinfo($fileSystem);
                $this->info["directory_name"] = realpath($info["dirname"]);
                $this->dates["last_access_time"] = DateTime::parse(date("Y-m-d", fileatime($fileSystem)));
                $this->dates["last_write_time"] = DateTime::parse(date("Y-m-d", filemtime($fileSystem)));
                $this->dates["created_time"] = DateTime::parse(date("Y-m-d", filectime($fileSystem)));
                
                if($this->info["directory_name"] == Path::DirectorySeparatorChar)
                {
                    $this->info["full_name"] = $this->info["directory_name"].basename($fileSystem);    
                }
                else
                {
                    $this->info["full_name"] = $this->info["directory_name"].Path::DirectorySeparatorChar.basename($fileSystem);
                }

                $this->info["exists"] = true;
            }

            $this->info["name"] = basename($this->info["full_name"]);
            $this->info["extension"] = "";
            $this->attributes = FileAttributes::directory();
        }
    }
}
