<?php

namespace System\IO {

    use \System\ArgumentNullException as ArgumentNullException;
    use \System\ArgumentException as ArgumentException;
    use \System\String as String;

    use \System\IO\DirectoryNotFoundException as DirectoryNotFoundException;
    use \System\IO\FileInfo as FileInfo;
    use \System\IO\FileSystemInfo as FileSystemInfo;
    use \System\IO\PathTooLongException as PathTooLongException;
    use \System\IO\IOException as IOException;
    use \System\IO\SearchOption as SearchOption;

    /*
     * TODO: @methods CreateSubDirectory(DirectorySecurity)
     * TODO: @methods GetAcessControl(DirectorySecurity)
     * TODO: @methods GetAcessControl()
     * TODO: @methods MoveTo(string)
     */


    /**
     * Exposes instance methods for creating, moving, and enumerating through directories and subdirectories. This class cannot be inherited.
     * @access public
     * @package System
     * @subpackage IO
     * @name DirectoryInfo
     */
    final class DirectoryInfo extends FileSystemInfo 
    {

        const MaxPathSize = 248;

        private $parent = null;
        private $directories = array();
        private $files = array();

        /**
         * Initializes a new instance of the System.IO.DirectoryInfo class on the specified path.
         * @access public
         * @throws \System\ArgumentNullException path is null.
         * @throws \System\Security\SecurityException The caller does not have the required permission.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length. For example, on Windows-based platforms, paths must be less than 248 characters, and file names must be less than 260 characters. The specified path, file name, or both are too long.
         * @param string $path A string specifying the path on which to create the DirectoryInfo.
         * @return \System\IO\DirectoryInfo path A string specifying the path on which to create the DirectoryInfo.
         */
        public function __construct($path) 
        {
            $this->setPropertiesToDirectory($path);
            $this->validatePathName($path);
        }

        /**
         * Creates a directory.
         * @access public
         * @throws \System\IOException The directory cannot be created.
         * @return void
         */
        public function create() 
        {
            try 
            {
                mkdir($this->fullName());
                $this->setPropertiesToDirectory($this->fullName());
            } 
            catch(\Exception $ex) 
            {
                throw new IOException("The directory cannot be created.");
            }
        }

        /**
         * Creates a sub-directory or sub-directories on the specified path. The specified path can be relative to this instance of the system.io.DirectoryInfo class.
         * @access public
         * @throws \System\ArgumentNullException path is null.
         * @throws \System\IO\IOException The directory cannot be created.
         * @param string $path The specified path. This cannot be a different disk volume or Universal Naming Convention (UNC) name.
         * @param DirectorySecurity $directorySecurity The security to apply.
         * @return \System\IO\DirectoryInfo The last directory specified in path.
         */
        public function createSubDirectory($path) 
        {
            if(is_null($path)) 
            {
                throw new ArgumentNullException("path is null.");
            }

            $subdirectory_name = $this->fullName().Path::DirectorySeparatorChar.$path;
            $this->validatePathName($subdirectory_name);

            try
            {
                if (!file_exists($this->fullName()))
                {
                    $this->create();
                }

                mkdir($subdirectory_name, 0777);
            } 
            catch(\Exception $e)
            {
                throw new IOException("The directory cannot be created.");
            }
            
            return new DirectoryInfo($subdirectory_name);
        }

        /**
         * Deletes this instance of a System.IO.DirectoryInfo, specifying whether to delete subdirectories and files.
         * @access public
         * @throws \System\IOException The directory is read-only. -or- The directory contains one or more files or subdirectories and recursive is false.  -or- The directory is the application's current working directory. -or- The directory not exists.
         * @param bool $recursive true to delete this directory, its subdirectories, and all files; otherwise, false.
         * @return void
         */
        public function delete($recursive = false) {
            
            if(!is_writeable($this->fullName())) 
            {
                throw new IOException("The directory is read-only.");
            }

            if(!$recursive && $this->hasChildren()) 
            {
                throw new IOException("The directory contains one or more files or subdirectories and recursive is false.  -or- The directory is the application's current working directory.");
            }

            if (!file_exists($this->fullName()))
            {
                throw new IOException("The directory not exists.");
            }

            $this->deleteChildrens($this->fullName(), $recursive);
            rmdir($this->fullName());
        }

        private function deleteChildrens($dir, $recursive) 
        {
            $resources = scandir($dir);

            for($index = 0; $index < sizeof($resources); $index++)
            {
                $name = $resources[$index];

                if (!$this->isChildren($name))
                {
                    continue;
                }

                $item = $dir . Path::AltDirectorySeparatorChar . $name;

                if(is_dir($item))
                {
                    if($recursive)
                    {
                        $this->deleteChildrens($item, $recursive);
                    }
                    
                    rmdir($item);
                }
                else
                {
                    unlink($item);
                }
            }
        }

        /**
         *
         * @access public
        */
        public function fullName() 
        {
            return $this->info["FULL_NAME"];
        }

        /**
         * Gets a System.Security.AccessControl.DirectorySecurity object that encapsulates the access control list (ACL) entries for the directory described by the current System.IO.DirectoryInfo object.
         * @access public
         * @throws SystemException|UnauthorizedAccessException|IOException|PlatformNotSupportedException|UnauthorizedAccessException
         * @return DirectorySecurity A System.Security.AccessControl.DirectorySecurity object that encapsulates the access control rules for the directory.
         */
        public function getAccessControl() 
        {
            //TODO: Implement GetAccessControl
        }

        /**
         * Returns an array of directories in the current System.IO.DirectoryInfo matching the given search criteria and using a value to determine whether to search subdirectories.
         * @access public
         * @throws \System\ArgumentNullException searchPattern is null.
         * @throws \System\IO\DirectoryNotFoundException 
         * @throws \System\Security\SecurityException
         * @param string $pattern The search string, such as "System*", used to search for all directories beginning with the word "System".
         * @param \System\IO\SearchOption $searchOptions One of the values of the System.IO.SearchOption enumeration that specifies whether the search operation should include only the current directory or should include all subdirectories.
         * @return array An array of type DirectoryInfo matching searchPattern.
         */
        public function getDirectories($pattern = "", SearchOption $searchOptions = null) 
        {
            if(is_null($pattern)) 
            {
                throw new ArgumentNullException("searchPattern is null.");
            }
            
            if(strlen($pattern) == 0) 
            {
                if(!$this->hasLoadedFileSystemObjects())
                {
                    $this->getFileSystemObjects();
                }

                return $this->directories;
            }
            return $this->searchDirectories($pattern, $searchOptions);
        }

        

        /**
         * Returns a file list from the current directory matching the given searchPattern and using a value to determine whether to search subdirectories.
         * @access public
         * @throws \System\ArgumentNullException searchPattern is null.
         * @throws \System\IO\DirectoryNotFoundException 
         * @throws \System\Security\SecurityException
         * @param string $pattern The search string, such as "System*", used to search for all directories beginning with the word "System".
         * @param SearchOption $searchOptions One of the values of the System.IO.SearchOption enumeration that specifies whether the search operation should include only the current directory or should include all subdirectories.
         * @return array
         */
        public function getFiles($pattern = "", SearchOption $searchOptions = null) 
        {
            if(is_null($pattern)) 
            {
                throw new ArgumentNullException("searchPattern is null.");
            }
            
            if(strlen($pattern) == 0) 
            {
                if(!$this->hasLoadedFileSystemObjects())
                {
                    $this->getFileSystemObjects();
                }

                return $this->files;
            }
            return $this->searchFiles($pattern, $searchOptions);
        }

        /**
         * Retrieves an array of strongly typed System.IO.FileSystemInfo objects representing the files and subdirectories matching the specified search criteria.
         * @access public
         * @throws \System\ArgumentNullException pattern is null.
         * @throws \System\IO\DirectoryNotFoundException
         * @throws \System\Security\SecurityException
         * @param string $pattern The search string, such as "System*", used to search for all directories beginning with the word "System".
         * @return array An array of strongly typed FileSystemInfo objects matching the search criteria.
         */
        public function getFileSystemInfos($pattern = "") 
        {
            return array_merge($this->getDirectories($pattern), $this->getFiles($pattern));;
        }

        /**
         * Support method to load all filesystemobjects
         * @access private
        */
        private function getFileSystemObjects() 
        {
            $resources = scandir($this->fullName());

            for($index = 0; $index < sizeof($resources); $index++)
            {
                $this->addResource($resources[$index]);
            }
        }

        private function addResource($resource) 
        {
            if ($this->isChildren($resource)) 
            {
                if (is_dir($this->getChildrenFullName($resource)))
                {
                    $this->directories[] = new DirectoryInfo($this->getChildrenFullName($resource));
                }
                else if (is_file($this->getChildrenFullName($resource))) 
                {
                    $this->files[] = new FileInfo($this->getChildrenFullName($resource));
                }
            }
        }

        /**
         * Check if all filesystemobjects was loaded
        */
        private function hasLoadedFileSystemObjects()
        {
            return (sizeof($this->directories) + sizeof($this->files)) > 0;
        }

        /**
         * Search directories recursive if searchOptions = AllDirectories
         * @param $pattern
         * @param $searchOptions
         * @return array
         */
        private function searchDirectories($pattern, $searchOptions=null) 
        {
            $directories = $this->getDirectories();
            $array = array();

            for($index = 0; $index < sizeof($directories); $index++) 
            {
                if(preg_match($pattern, $directories[$index]->name()))
                {
                    $array[] = $directories[$index];
                }
                
                if($searchOptions == SearchOption::allDirectories())
                {
                    $childrens = $directories[$index]->getDirectories($pattern, $searchOptions);
                    $array = array_merge($array, $childrens);
                }
            }
            return $array;
        }

        /**
         * Search files -or- recursive if searchOptions == AllDirectories
         * @param $pattern
         * @param $searchOptions
         * @return array
         */
        private function searchFiles($pattern, $searchOptions=null) 
        {
            $directories = $this->getDirectories();
            $files = $this->getFiles();
            $array = array();

            for($index = 0; $index < sizeof($files); $index++) 
            {
                if(preg_match($pattern, $files[$index]->name()))
                {
                    $array[] = $files[$index];
                }
            }

            if($searchOptions == SearchOption::allDirectories()) 
            {
                for($index = 0; $index < sizeof($directories); $index++) 
                {
                    $array = array_merge($array, $directories[$index]->getFiles($pattern,$searchOptions));
                }
            }
            return $array;
        }

        /**
         * Moves a system.io.DirectoryInfo instance and its contents to a new path.
         * @access public
         * @throws \System\ArgumentNullException destDirName is null.
         * @throws \System\ArgumentException destDirName already exists.
         * @throws \System\IOException
         * @throws \System\Security\SecurityException
         * @throws \System\IO\DirectoryNotFoundException destDirName does not exists.
         * @param string $destDirName The name and path to which to move this directory. The destination cannot be another disk volume or a directory with the identical name. It can be an existing directory to which you want to add this directory as a subdirectory.
         * @return void
         */
        public function moveTo($destDirName) 
        {
            if(is_null($destDirName)) 
            {
                throw new ArgumentNullException("destDirName is null.");
            }

            if (!file_exists($destDirName))
            {
                throw new DirectoryNotFoundException("destDirName does not exists.");   
            }

            $destination = realpath($destDirName) . Path::AltDirectorySeparatorChar. $this->name();

            if(file_exists($destination)) 
            {
                throw new ArgumentException("destDirName already exists.");
            }

            try
            {
                $this->copyDirectory($this->fullName(), $destination);    
            }
            catch(\Exception $ex)
            {
                throw new IOException("");
            }
            
            # Remove old references
            $this->delete(true);
            $this->setPropertiesToDirectory($destination);
            $this->directories = array();
            $this->files = array();
            $this->parent = null;
        }

        /**
         * Recursive method to copy from directory to other directory
         * @param $source
         * @param $destination
         * @return void
         */
        private function copyDirectory($source, $destination) 
        {
            if(!file_exists($destination))
            {
                mkdir($destination);
            }
                
            $directory = dir($source);
            while (FALSE !== ($current = $directory->read())) 
            {
                if (!$this->isChildren($current)) 
                {
                    continue;
                }

                $path_dir = $source . Path::AltDirectorySeparatorChar . $current;
                $sub_destination = $destination . Path::AltDirectorySeparatorChar . $current;
                
                if (is_dir($path_dir)) 
                {
                    $this->copyDirectory($path_dir, $sub_destination);
                    continue;
                }
                
                copy($path_dir, $sub_destination);
            }
            $directory->close();
        }

        public function name() 
        {
            return $this->info["NAME"];
        }

        /**
         * Gets the parent directory of a specified subdirectory.
         * @access public
         * @throws \System\Security\SecurityException
         * @return DirectoryInfo The parent directory, or null if the path is null or if the file path denotes a root (such as "\", "C:", or * "\\server\share").
         */
        public function parent() 
        {
            if(is_null($this->parent))
            {
                $parent_path = str_replace($this->name(), "", $this->fullName());
                $this->parent = new DirectoryInfo($parent_path);
            }

            return $this->parent;
        }

        /**
         * Refreshes the state of the object.
         * @access public
         * @throws \System\IO\IOException
         * @return void
         */
        public function refresh() 
        {
            $this->setPropertiesToDirectory($this->fullName());
        }

        /**
         * Gets the root portion of a path.
         * @access public
         * @throws \System\Security\SecurityException
         * @return DirectoryInfo A System.IO.DirectoryInfo object representing the root of a path.
         */
        public function root() 
        {
            $path = explode(Path::AltDirectorySeparatorChar, $this->fullName());
            
            if (empty($path[1]))
            {
                return new DirectoryInfo(Path::AltDirectorySeparatorChar);
            }

            return new DirectoryInfo($path[0].Path::AltDirectorySeparatorChar.$path[1]);
        }


        /**
         * This method validate if path is valid.
         * @access private
         * @throws \System\ArgumentNullException path is null.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length. For example, on Windows-based platforms, paths must be less than 248 characters, and file names must be less than 260 characters. The specified path, file name, or both are too long.
         * @throws \System\IO\IOException The subdirectory cannot be created.  -or- A file or directory already has the name specified by path
         * @param string $path pathName 
         * @return bool
         */
        private function validatePathName($path) 
        {
            if(empty($path)) 
            {
                throw new ArgumentNullException("path is null.");
            }

            if(strlen($path) > self::MaxPathSize) 
            {
                throw new PathTooLongException("The specified path, file name, or both exceed the system-defined maximum length. For example, on Windows-based platforms, paths must be less than 248 characters, and file names must be less than 260 characters. The specified path, file name, or both are too long.");
            }

            if(file_exists($this->fullName()) && !is_dir($this->fullName())) 
            {
                throw new IOException("The subdirectory cannot be created.  -or- A file or directory already has the name specified by path");
            }

            return true;
        }

        /**
         * Validate if resource is children
         * @param $resource
         * @return bool
         */
        private function isChildren($resource) {
            return ($resource != "." && $resource != "..");
        }

        /**
         * Get total childrens
         * @return int
         */
        private function hasChildren() 
        {
            $totalSize = sizeof(scandir($this->fullName()));
            return $totalSize > 2;
        }

        /**
         * Get full name of children
         * @param string $name
         * @return string
         */
        private function getChildrenFullName($name) 
        {
            return $this->fullName() . Path::AltDirectorySeparatorChar . $name;
        }
    }
}
