<?php

namespace System\IO
{
    use \System\DateTime as DateTime;
    use \System\IO\FileAttributes as FileAttributes;
    use \System\IO\Path as Path;

    /**
     * Provides the base class for both system.io.FileInfo and system.io.DirectoryInfo objects.
     *
     * @access public
     * @name FileSystemInfo
     * @package System
     * @subpackage IO
     */
    abstract class FileSystemInfo
    {
        protected $dates = array('createdTime' => NULL, 'modifiedTime' => NULL, 'accessTime' => NULL);
        protected $attributes = NULL;
        protected $infos = array('exists' => false, 'extension' => NULL, 'name' => NULL,
                                 'directoryName' => NULL, 'fullName' => NULL);

        /**
         * Gets or sets the attributes for the current file or directory.
         *
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
         * Gets the creation time of the current FileSystemInfo object.
         *
         * @access public
         * @param \System\DateTime $creationTime The creation date and time of the current System.IO.FileSystemInfo object
         * @return \System\DateTime The creation date and time of the current System.IO.FileSystemInfo object.
         */
        public function creationTime(DateTime $creationTime = null)
        {
            if(!is_null($creationTime))
            {
                $this->dates['createdTime'] = $creationTime;
            }
            return $this->dates['createdTime'];
        }

        /**
         * Gets the creation time, in coordinated universal time (UTC), of the current file or directory.
         *
         * @access public
         * @return \System\DateTime The creation date and time of the current System.IO.FileSystemInfo object.
         */
        public function creationTimeUtc()
        {
            return $this->dates['createdTime']->utcNow();
        }

        /**
         * Gets a value indicating whether the file or directory exists.
         *
         * @access public
         * @return bool true if the file or directory exists; otherwise, false.
         */
        public function exists()
        {
            return $this->infos["exists"];
        }

        /**
         * Gets the string representing the extension part of the file.
         *
         * @access public
         * @return string A string containing the system.io.FileSystemInfo extension.
         */
        public function extension()
        {
            return $this->infos['extension'];
        }

        /**
         * Gets the full path of the directory or file.
         *
         * @access public
         * @abstract
         * @return string A string containing the full path.
         */
        public abstract function fullName();

        /**
         * Gets or sets the time the current file or directory was last accessed.
         *
         * @access public
         * @param \System\DateTime $accessTime sets the time
         * @return \System\DateTime The time that the current file or directory was last accessed.
         */
        public function lastAccessTime(DateTime $accessTime = null)
        {
            if(!is_null($accessTime))
            {
                $this->dates['accessTime'] = $accessTime;
                touch($this->fullName(), $this->dates['modifiedTime']->toBinary(), $accessTime->toBinary());
            }
            return $this->dates['accessTime'];
        }

        /**
         * Gets the time, in coordinated universal time (UTC), that the current file or directory was last accessed.
         *
         * @access public
         * @return \System\DateTime The time that the current file or directory was last accessed.
         */
        public function lastAccessTimeUtc()
        {
            return $this->dates['accessTime']->utcNow();
        }

        /**
         * Gets or sets the time when the current file or directory was last written to.
         *
         * @access public
         * @param \System\DateTime $writeTime sets the time
         * @return \System\DateTime The time the current file was last written.
         */
        public function lastWriteTime(DateTime $writeTime = null)
        {
            if(!is_null($writeTime))
            {
                $this->dates["modifiedTime"] = $writeTime;
                touch($this->fullName(), $writeTime->toBinary(), $this->dates['accessTime']->toBinary());
            }
            return $this->dates["modifiedTime"];
        }

        /**
         * Gets the time, in coordinated universal time (UTC), that the current file or directory was last written to.
         *
         * @access public
         * @return \System\DateTime The time that the current file or directory was last written to.
         */
        public function lastWriteTimeUtc()
        {
            return $this->dates["modifiedTime"]->utcNow();
        }

        /**
         * For files, gets the name of the file. For directories, gets the name of the last directory in the hierarchy if a hierarchy exists. Otherwise, the Name property gets the name of the directory.
         *
         * @access public
         * @abstract
         * @return String  A string that is the name of the parent directory, the name of the last directory in the hierarchy, or the name of a file, including the file name extension.
         */
        public abstract function name();


        /**
         * Provides information for files and directories.
         * @param string $fileSystem
         */
        protected function setPropertiesToFile($fileSystem) {
            $info = pathinfo($fileSystem);
            $this->infos["directoryName"] = realpath($info["dirname"]);
            $this->infos["name"] = $info["filename"];
            $this->infos["extension"] = isset($info["extension"]) ? $info["extension"] : "";
            $this->infos["fullName"] = $this->infos["directoryName"].DIRECTORY_SEPARATOR.$this->infos["name"].".".$this->infos["extension"];
            $this->infos["exists"] = file_exists($fileSystem);

            if(!$this->infos["exists"])
            {
                $this->dates["accessTime"] = DateTime::now();
                $this->dates["modifiedTime"] = DateTime::now();
                $this->dates["createdTime"] = DateTime::now();
            }
            else
            {
                $this->dates["accessTime"] = DateTime::parse(date("Y-m-d", fileatime($fileSystem)));
                $this->dates["modifiedTime"] = DateTime::parse(date("Y-m-d", filemtime($fileSystem)));
                $this->dates["createdTime"] = DateTime::parse(date("Y-m-d", filectime($fileSystem)));
            }

            $this->attributes = FileAttributes::archive();
        }

        protected function setPropertiesToDirectory($fileSystem)
        {
            if(!file_exists($fileSystem))
            {
                $this->infos["directoryName"] = $fileSystem;
                $this->dates["accessTime"] = DateTime::now();
                $this->dates["modifiedTime"] = DateTime::now();
                $this->dates["createdTime"] = DateTime::now();
                $this->infos["fullName"] = $this->infos["directoryName"];
                $this->infos["exists"] = false;
            }
            else
            {
                $info = pathinfo($fileSystem);
                $this->infos["directoryName"] = realpath($info["dirname"]);
                $this->dates["accessTime"] = DateTime::parse(date("Y-m-d", fileatime($fileSystem)));
                $this->dates["modifiedTime"] = DateTime::parse(date("Y-m-d", filemtime($fileSystem)));
                $this->dates["createdTime"] = DateTime::parse(date("Y-m-d", filectime($fileSystem)));

                if($this->infos["directoryName"] == DIRECTORY_SEPARATOR)
                {
                    $this->infos["fullName"] = $this->infos["directoryName"].basename($fileSystem);
                }
                else
                {
                    $this->infos["fullName"] = $this->infos["directoryName"].DIRECTORY_SEPARATOR.basename($fileSystem);
                }

                $this->infos["exists"] = true;
            }

            $this->infos["name"] = basename($this->infos["fullName"]);
            $this->infos["extension"] = "";
            $this->attributes = FileAttributes::directory();
        }
    }
}
