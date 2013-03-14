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
    final class DirectoryInfo extends FileSystemInfo {

        const MaxPathSize = 248;

        private $parent;
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
        public function create() {
            try {
                mkdir($this->fullName());
                $this->setPropertiesToDirectory($this->fullName());
            } catch(\Exception $ex) {
                throw new IOException("The directory cannot be created.");
            }
        }

        /**
         * Creates a sub-directory or sub-directories on the specified path. The specified path can be relative to this instance of the system.io.DirectoryInfo class.
         * @access public
         * @param String $path The specified path. This cannot be a different disk volume or Universal Naming Convention (UNC) name.
         * @param DirectorySecurity $directorySecurity The security to apply.
         * @return DirectoryInfo The last directory specified in path.
         */
        public function createSubDirectory($path, DirectorySecurity $directorySecurity=null) {
            $subDirectoryName = $this->fullName().Path::DirectorySeparatorChar.$path;
            if(is_null($path)) throw new ArgumentNullException("path is null.");
            if(file_exists($subDirectoryName)) throw new IOException("The directory cannot be created.");
            $this->validatePathName($subDirectoryName);
            mkdir($subDirectoryName, 0777);
            return new DirectoryInfo($subDirectoryName);
        }

        /**
         * Deletes this instance of a System.IO.DirectoryInfo, specifying whether to delete subdirectories and files.
         * @throws \System\IOException The directory is read-only. -or- The directory contains one or more files or subdirectories and recursive is false.  -or- The directory is the application's current working directory.
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

            $this->deleteChildrenFiles($this->getFiles());
            $this->deleteChildrenDirectories($this->getDirectories(), $recursive);
            rmdir($this->fullName());
        }

        private function deleteChildrenFiles($files) {
            for ($index = 0; $index < sizeof($files); $index++)
                $files[$index]->delete();
        }

        private function deleteChildrenDirectories($directories, $recursive) {
            for($index = 0; $index < sizeof($directories); $index++)
                $directories[$index]->delete($recursive);
        }

        public function fullName() {
            return $this->info["FULL_NAME"];
        }

        /**
         * Gets a System.Security.AccessControl.DirectorySecurity object that encapsulates the access control list (ACL) entries for the directory described by the current System.IO.DirectoryInfo object.
         * @access public
         * @throws SystemException|UnauthorizedAccessException|IOException|PlatformNotSupportedException|UnauthorizedAccessException
         * @return DirectorySecurity A System.Security.AccessControl.DirectorySecurity object that encapsulates the access control rules for the directory.
         */
        public function getAccessControl() {
            //TODO: Implement GetAccessControl
        }

        /**
         * Returns an array of directories in the current System.IO.DirectoryInfo matching the given search criteria and using a value to determine whether to search subdirectories.
         * @access public
         * @throws ArgumentNullException|DirectoryNotFoundException|SecurityException
         * @param string $pattern The search string, such as "System*", used to search for all directories beginning with the word "System".
         * @param SearchOption $searchOptions One of the values of the System.IO.SearchOption enumeration that specifies whether the search operation should include only the current directory or should include all subdirectories.
         * @return array An array of type DirectoryInfo matching searchPattern.
         */
        public function getDirectories($pattern="",$searchOptions=null) {
            if(is_null($pattern)) throw new ArgumentNullException("searchPattern is null.");
            if(strlen($pattern) == 0) {
                if(!$this->hasLoadedResources())
                    $this->loadResources();
                return $this->directories;
            }
            return $this->searchDirectories($pattern, $searchOptions);
        }

        private function hasLoadedResources()
        {
            return (sizeof($this->directories) + sizeof($this->files)) > 0;
        }

        /**
         * Returns a file list from the current directory matching the given searchPattern and using a value to determine whether to search subdirectories.
         * @throws ArgumentNullException|DirectoryNotFoundException|SecurityException
         * @param string $pattern The search string, such as "System*", used to search for all directories beginning with the word "System".
         * @param SearchOption $searchOptions One of the values of the System.IO.SearchOption enumeration that specifies whether the search operation should include only the current directory or should include all subdirectories.
         * @return array
         */
        public function getFiles($pattern="", $searchOptions=null) {
            if(is_null($pattern)) throw new ArgumentNullException("searchPattern is null.");
            if(strlen($pattern) == 0) {
                if(!$this->hasLoadedResources())
                    $this->loadResources();
                return $this->files;
            }
            return $this->searchFiles($pattern, $searchOptions);
        }

        /**
         * Retrieves an array of strongly typed System.IO.FileSystemInfo objects representing the files and subdirectories matching the specified search criteria.
         * @access public
         * @throws ArgumentNullException|DirectoryNotFoundException|SecurityException
         * @param string $pattern The search string, such as "System*", used to search for all directories beginning with the word "System".
         * @return array An array of strongly typed FileSystemInfo objects matching the search criteria.
         */
        public function getFileSystemInfos($pattern="") {
            $array = array_merge($this->getDirectories($pattern), $this->getFiles($pattern));
            return $array;
        }

        /**
         * Moves a system.io.DirectoryInfo instance and its contents to a new path.
         * @access public
         * @throws ArgumentNullException|ArgumentException|IOException|SecurityException|DirectoryNotFoundException
         * @param string $destDirName The name and path to which to move this directory. The destination cannot be another disk volume or a directory with the identical name. It can be an existing directory to which you want to add this directory as a subdirectory.
         * @return void
         */
        public function moveTo($destDirName) {
            if($destDirName == null) throw new ArgumentNullException("destDirName is null.");
            $destination = realpath($destDirName)."\\".$this->name();
            if(file_exists($destination)) throw new IOException("destDirName already exists.");
            $this->_copyDirectory($this->fullName(), $destination);
            $this->delete(true);
            $this->setPropertiesToDirectory($destination);
        }

        public function name() {
            return $this->info["NAME"];
        }

        /**
         * Gets the parent directory of a specified subdirectory.
         * @access public
         * @throws SecurityException
         * @return DirectoryInfo The parent directory, or null if the path is null or if the file path denotes a root (such as "\", "C:", or * "\\server\share").
         */
        public function parent() {
            if($this->parent == null)
                $this->parent = new DirectoryInfo(str_replace($this->name(), "", $this->fullName()));
            return $this->parent;
        }

        /**
         * Refreshes the state of the object.
         * @access public
         * @throws IOException
         * @return void
         */
        public function refresh() {
            $this->setPropertiesToDirectory($this->fullName());
        }

        /**
         * Gets the root portion of a path.
         * @access public
         * @throws SecurityException
         * @return DirectoryInfo A System.IO.DirectoryInfo object representing the root of a path.
         */
        public function root() {
            $currentDirectory = explode("\\", $this->fullName());
            return new DirectoryInfo($currentDirectory[0]);
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
         * Method to get all directories and convert to DirectoryInfo objects
         * @return array
         */
        private function loadResources() {
            $resources = scandir($this->fullName());
            for($index = 0; $index < sizeof($resources); $index++)
                $this->addResource($resources[$index]);
        }

        private function addResource($resource) {
            if ($this->isChildren($resource)) {
                if (is_dir($this->getChildrenFullName($resource)))
                    $this->directories[] = new DirectoryInfo($this->getChildrenFullName($resource));
                else if (is_file($this->getChildrenFullName($resource))) {
                    $this->files[] = new FileInfo($this->getChildrenFullName($resource));
                }
            }
        }


        /**
         * Search directories recursive if searchOptions = AllDirectories
         * @param $pattern
         * @param $searchOptions
         * @return array
         */
        private function searchDirectories($pattern, $searchOptions=null) {
            $directories = $this->getDirectories();
            $array = array();

            for($index = 0; $index < sizeof($directories); $index++) {
                if(preg_match($pattern, $directories[$index]->name()))
                    $array[] = $directories[$index];
                if($searchOptions == SearchOption::AllDirectories)
                    $array = array_merge($array, $directories[$index]->getDirectories($pattern,$searchOptions));
            }
            return $array;
        }

        /**
         * Search files -or- recursive if searchOptions == AllDirectories
         * @param $pattern
         * @param $searchOptions
         * @return array
         */
        private function searchFiles($pattern, $searchOptions=null) {
            $directories = $this->getDirectories();
            $files = $this->getFiles();
            $array = array();

            for($index = 0; $index < sizeof($files); $index++) {
                if(preg_match($pattern, $files[$index]->name()))
                    $array[] = $files[$index];

            }

            if($searchOptions == SearchOption::AllDirectories) {
                for($index = 0; $index < sizeof($directories); $index++) {
                    $array = array_merge($array, $directories[$index]->getFiles($pattern,$searchOptions));
                }
            }
            return $array;
        }

        /**
         * Recursive method to copy from directory to other directory
         * @param $source
         * @param $destination
         * @return void
         */
        private function _copyDirectory($source, $destination) {
            if ( is_dir( $source ) ) {
                if(!file_exists($destination))
                    mkdir($destination);
                $directory = dir( $source );
                while ( FALSE !== ( $readDirectory = $directory->read() ) ) {
                    if ( $readDirectory == '.' || $readDirectory == '..' ) {
                        continue;
                    }
                    $PathDir = $source . '\\' . $readDirectory;
                    if ( is_dir( $PathDir ) ) {
                        $this->_copyDirectory( $PathDir, $destination . '\\' . $readDirectory );
                        continue;
                    }
                    copy( $PathDir, $destination . '\\' . $readDirectory );
                }
                $directory->close();
            }else {
                copy( $source, $destination );
            }
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
        private function hasChildren() {
            $totalSize = sizeof(scandir($this->fullName()));
            return $totalSize > 2;
        }

        /**
         * Get full name of children
         * @param string $name
         * @return string
         */
        private function getChildrenFullName($name) {
            return $this->fullName() . "\\" . $name;
        }
    }
}
