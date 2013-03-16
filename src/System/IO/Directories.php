<?php

namespace System\IO {

    use \System\IO\DirectoryInfo as DirectoryInfo;
    use \System\IO\FileInfo as FileInfo;

    /*
     * TODO: Implement GetAccessControl
     */

    /**
     * Exposes static methods for creating, moving, and enumerating through directories and subdirectories. This class cannot be inherited.
     * @access public
     * @name Directories
     * @package System
     * @subpackage IO
     */
    final class Directories 
    {
    
        /**
         * Creates all the directories in the specified path, applying the specified Windows security.
         * @static
         * @access public
         * @throws \System\IO\IOException
         * @throws \System\Security\UnauthorizedAccessException
         * @throws \System\ArgumentException 
         * @throws \System\ArgumentNullException
         * @throws \System\PathTooLongException
         * @throws \System\IO\DirectoryNotFoundException
         * @param string $path The directory to create.
         * @param $directorySecurity The access control to apply to the directory.
         * @return \System\IO\DirectoryInfo A DirectoryInfo object representing the newly created directory.
         */
        public static function createDirectory($path, $directorySecurity=null) 
        {
            $directory = new DirectoryInfo($path);
            $directory->create();
            return $directory;
        }


        /**
         * Deletes the specified directory and, if indicated, any subdirectories in the directory.
         * @static
         * @access public
         * @param string $path The name of the directory to remove.
         * @param bool $recursive true to remove directories, subdirectories, and files in path; otherwise, false. 
         * @return void
         */
        public static function delete($path, $recursive=false) 
        {
            $directory = new DirectoryInfo($path);
            $directory->delete($recursive);
        }

        /**
         * Determines whether the given path refers to an existing directory on disk.
         * @static
         * @access public
         * @param string $path The path to test.
         * @return void true if path refers to an existing directory; otherwise, false.
         */
        public static function exists($path) 
        {
            return (file_exists($path) && is_dir($path));
        }


        /**
         * Gets the creation date and time of a directory.
         * @static
         * @access public
         * @param string $path The path of the directory.
         * @return \System\DateTime A System.DateTime structure set to the creation date and time for the specified directory. This value is expressed in local time.
         */
        public static function getCreationTime($path) 
        {
            $directoryInfo = new DirectoryInfo($path);
            return $directoryInfo->creationTime();
        }

        /**
         * Gets the creation date and time, in Coordinated Universal Time (UTC) format, of a directory.
         * @static
         * @access public
         * @param string $path The path of the directory.
         * @return \System\DateTime A System.DateTime structure set to the creation date and time for the specified directory. This value is expressed in local time.
         */
        public static function getCreationTimeUtc($path) 
        {
            $directoryInfo = new DirectoryInfo($path);
            return $directoryInfo->creationTimeUtc();
        }

        /**
         * Gets the current working directory of the application.
         * @static
         * @access public
         * @return string A string containing the path of the current working directory.
         */
        public static function getCurrentDirectory() 
        {
            return getcwd();
        }


        /**
         * Gets the names of subdirectories in the specified directory.
         * @static
         * @access public
         * @throws \System\Security\UnauthorizedAccessException
         * @throws \System\ArgumentException
         * @throws \System\ArgumentNullException
         * @throws \System\IO\PathTooLongException
         * @throws \System\IO\IOException
         * @throws \System\IO\DirectoryNotFoundException
         * @param string $path The path for which an array of subdirectory names is returned.
         * @param string $pattern The search string to match against the names of files in path. The parameter cannot end in two periods ("..") or contain two periods ("..") followed by System.IO.Path.DirectorySeparatorChar or System.IO.Path.AltDirectorySeparatorChar, nor can it contain any of the characters in System.IO.Path.InvalidPathChars.
         * @param \System\IO\SearchOption $searchOption One of the System.IO.SearchOption values that specifies whether the search operation should include all subdirectories or only the current directory.
         * @return array An array of type String containing the names of subdirectories in path.
         */
        public static function getDirectories($path, $pattern = "", SearchOption $searchOption = null) {
            
            $info = new DirectoryInfo($path);
            $childrens = $info->getDirectories($pattern, $searchOption);
            $names = array();
            
            foreach($childrens as $dir) 
            {
                array_push($names, $dir->name());
            }
                
            return $names;
        }


        /**
         * Returns the volume information, root information, or both for the specified path.
         * @static
         * @access public
         * @throws \System\Security\UnauthorizedAccessException
         * @throws \System\ArgumentException
         * @throws \System\ArgumentNullException
         * @throws \System\IO\PathTooLongException
         * @param string $path The path of a file or directory.
         * @return string A string containing the volume information, root information, or both for the specified path.
         */
        public static function getDirectoryRoot($path) 
        {
            $directoryInfo = new DirectoryInfo($path);
           return $directoryInfo->root()->name();
        }


        /**
         * Returns the names of files in the specified directory that match the specified search pattern, using a value to determine whether to search subdirectories.
         * @static
         * @access public
         * @throws \System\Security\UnauthorizedAccessException
         * @throws \System\ArgumentException
         * @throws \System\ArgumentNullException
         * @throws \System\IO\PathTooLongException
         * @throws \System\IO\IOException
         * @throws \System\IO\DirectoryNotFoundException
         * @param string $path The path for which an array of subdirectory names is returned.
         * @param string $pattern The search string to match against the names of files in path. The parameter cannot end in two periods ("..") or contain two periods ("..") followed by System.IO.Path.DirectorySeparatorChar or System.IO.Path.AltDirectorySeparatorChar, nor can it contain any of the characters in System.IO.Path.InvalidPathChars.
         * @param \System\IO\SearchOption $searchOption One of the System.IO.SearchOption values that specifies whether the search operation should include all subdirectories or only the current directory.
         * @return array An array of type String containing the names of subdirectories in path.
         */
        public static function getFiles($path, $pattern="", SearchOption $searchOption=null) {
            $directoryInfo = new DirectoryInfo($path);
            $files = $directoryInfo->getFiles($pattern, $searchOption);
            $names = array();
            
            foreach($files as $file)
            {
                array_push($names, $file->name());
            }

            return $names;
        }

        /**
         * Returns the names of files in the specified directory that match the specified search pattern, using a value to determine whether to search subdirectories.
         * @static
         * @access public
         * @throws \System\Security\UnauthorizedAccessException
         * @throws \System\ArgumentException
         * @throws \System\ArgumentNullException
         * @throws \System\IO\PathTooLongException
         * @throws \System\IO\IOException
         * @throws \System\IO\DirectoryNotFoundException
         * @param string $path The path for which an array of subdirectory names is returned.
         * @param string $pattern The search string to match against the names of files in path. The parameter cannot end in two periods ("..") or contain two periods ("..") followed by System.IO.Path.DirectorySeparatorChar or System.IO.Path.AltDirectorySeparatorChar, nor can it contain any of the characters in System.IO.Path.InvalidPathChars.
         * @return array An array of type String containing the names of subdirectories in path.
         */
        public static function getFileSytemEntries($path, $pattern="") 
        {
            $info = new DirectoryInfo($path);
            $entries = $info->getFileSystemInfos($pattern);
            $names = array();
            
            foreach($entries as $entry)
            {
                array_push($names, $entry->name());
            }
                
            return $names;
        }

        /**
         * Returns the date and time the specified file or directory was last accessed.
         * @static
         * @access public
         * @param string $path The file or directory for which to obtain access date and time information.
         * @return \System\DateTime A System.DateTime structure set to the date and time the specified file or directory was last accessed. This value is expressed in local time.
         */
        public static function getLastAccessTime($path) 
        {
            $info = new DirectoryInfo($path);
            return $info->lastAccessTime();
        }


        /**
         * Returns the date and time, in Coordinated Universal Time (UTC) format, that the specified file or directory was last accessed.
         * @static
         * @access public
         * @param string $path The file or directory for which to obtain access date and time information.
         * @return \System\DateTime A System.DateTime structure set to the date and time the specified file or directory was last accessed. This value is expressed in UTC time.
         */
        public static function getLastAccessTimeUtc($path) 
        {
            $info = new DirectoryInfo($path);
            return $info->lastAccessTimeUtc();
        }

        /**
         * Returns the date and time the specified file or directory was last written to.
         * @static
         * @access public
         * @param string $path The file or directory for which to obtain access date and time information.
         * @return \System\DateTime A System.DateTime structure set to the date and time the specified file or directory was last accessed. This value is expressed in UTC time.
         */
        public static function getLastWriteTime($path) 
        {
            $info = new DirectoryInfo($path);
            return $info->lastAccessTimeUtc();
        }

        /**
         * Returns the date and time, in Coordinated Universal Time (UTC) format, that the specified file or directory was last written to.
         * @static
         * @access public
         * @param string $path The file or directory for which to obtain modification date and time information.
         * @return \System\DateTime A System.DateTime structure set to the date and time the specified file or directory was last accessed. This value is expressed in UTC time.
         */
        public static function getLastWriteTimeUtc($path) 
        {
            $info = new DirectoryInfo($path);
            return $info->lastAccessTimeUtc();
        }


        /**
         * Retrieves the parent directory of the specified path, including both absolute and relative paths.
         * @static
         * @access public
         * @param string $path The path for which to retrieve the parent directory.
         * @return \System\IO\DirectoryInfo The parent directory, or null if path is the root directory, including the root of a UNC server or share name.
         */
        public static function getParent($path) 
        {
            $directory = new DirectoryInfo($path);
            return $directory->parent();
        }


        /**
         * Moves a file or a directory and its contents to a new location.
         * @static
         * @throws \System\Security\UnauthorizedAccessException
         * @throws \System\ArgumentException
         * @throws \System\ArgumentNullException
         * @throws \System\IO\PathTooLongException
         * @throws \System\IO\IOException
         * @throws \System\IO\DirectoryNotFoundException
         * @param string $sourceDirName The path of the file or directory to move.
         * @param string $destDirName The path to the new location for sourceDirName. If sourceDirName is a file, then destDirName must also be a file name.
         * @return void
         */
        public static function move($sourceDirName, $destDirName) 
        {
            $directory = new DirectoryInfo($sourceDirName);
            $directory->moveTo($destDirName);
        }
    }
}