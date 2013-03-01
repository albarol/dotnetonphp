<?php

namespace System\IO;

require_once(dirname(__FILE__).'/../ArgumentNullException.php');
require_once('PathTooLongException.php');
require_once('DirectoryInfo.php');
require_once('Files.php');


use \System\ArgumentNullException as ArgumentNullException;
use \System\ArgumentException as ArgumentException;


/**
 * Performs operations on System.String instances that contain file or directory path information. These operations are performed in a cross-platform manner.
 * @access public
 * @name Path
 * @package System
 * @subpackage IO
 */
final class Path {


    /**
     * Provides a platform-specific alternate character used to separate directory levels in a path string that reflects a hierarchical file system organization.
     */
    const AltDirectorySeparatorChar = '\\';


    /**
     * Provides a platform-specific character used to separate directory levels in a path string that reflects a hierarchical file system organization.
     */
    const DirectorySeparatorChar = DIRECTORY_SEPARATOR;

    /**
     * A platform-specific separator character used to separate path strings in environment variables.
     */
    const PathSeparator = PATH_SEPARATOR;

    /**
     * Provides a platform-specific volume separator character.
     */
    const VolumeSeparatorChar = ':';

    /**
     * Changes the extension of a path string.
     * @access public
     * @static
     * @param string $path The path information to modify. The path cannot contain any of the characters defined in System.IO.Path.GetInvalidPathChars.
     * @param string $extension The new extension (with or without a leading period). Specify null to remove an existing extension from path.
     * @return string A string containing the modified path information.
     */
    public static function changeExtension($path, $extension) {
        if(self::containsInvalidPathChars($path)) throw new \System\ArgumentException("path contains one or more of the invalid characters defined in System.IO.Path.GetInvalidPathChars.");
        if($path == null) return "";
        $info = pathinfo($path);
        if(!is_null($extension))
            return basename($path,'.'.$info['extension']).".".$extension;
        return basename($path,'.'.$info['extension']);
    }

    /**
     * Combines two path strings.
     * @access public
     * @static
     * @param string $pathOne The first path.
     * @param string $pathTwo The second path.
     * @return string A string containing the combined paths. If one of the specified paths is a zero-length string, this method returns the other path. If path2 contains an absolute path, this method returns path2.
     */
    public static function combine($pathOne, $pathTwo) {
        if(self::containsInvalidPathChars($pathOne) || self::containsInvalidPathChars($pathTwo)) throw new \System\ArgumentException("path1 or path2 contain one or more of the invalid characters defined in GetInvalidPathChars.");
        if(is_null($pathOne) || is_null($pathTwo)) throw new \System\ArgumentNullException("path1 or path2 is null.");
        if(strpos($pathTwo, self::VolumeSeparatorChar) !== false) return $pathTwo;
        return $pathOne.$pathTwo;
    }

    /**
     * Returns the directory information for the specified path string.
     * @access public
     * @static
     * @throws ArgumentException|PathTooLongException
     * @param string $path The path of a file or directory.
     * @return string Returns the directory information for the specified path string.
     */
    public static function getDirectoryName($path) {
        if(self::containsInvalidPathChars($path)) throw new \System\ArgumentException("The path parameter contains invalid characters, is empty, or contains only white spaces");
        if(strlen($path) > 248) throw new PathTooLongException("The path parameter is longer than the system-defined maximum length.");
        if(is_null($path) || strlen($path) == 0) return null;

        $directoryInfo = new DirectoryInfo($path);
        if(!$directoryInfo->exists()) return null;
        if($directoryInfo->root()->name() == $path) return null;
        return $directoryInfo->name();
    }

    /**
     * Returns the extension of the specified path string.
     * @access public
     * @static
     * @throws ArgumentException
     * @param string $path The path string from which to get the extension. 
     * @return string A System.String containing the extension of the specified path (including the "."), null, or System.String.Empty. If path is null, GetExtension returns null. If path does not have extension information, GetExtension returns Empty.
     */
    public static function getExtension($path) {
        if(self::containsInvalidPathChars($path)) throw new ArgumentException("path contains one or more of the invalid characters defined in System.IO.Path.GetInvalidPathChars.");
        $info = pathinfo($path);
        return $info["extension"];
    }

    /**
     * Returns the file name and extension of the specified path string.
     * @access public
     * @static
     * @throws ArgumentException
     * @param string $path The path string from which to obtain the file name and extension. 
     * @return string A System.String consisting of the characters after the last directory character in path. If the last character of path is a directory or volume separator character, this method returns System.String.Empty. If path is null, this method returns null.
     */
    public static function getFileName($path) {
        if(self::containsInvalidPathChars($path)) throw new ArgumentException("path contains one or more of the invalid characters defined in System.IO.Path.GetInvalidPathChars.");
        $info = pathinfo($path);
        return is_file($path) ? $info["filename"].".".$info["extension"] : "";
    }
    

    /**
     * Returns the file name of the specified path string without the extension.
     * @access public
     * @static
     * @throws ArgumentException
     * @param string $path The path of the file. 
     * @return string A System.String containing the string returned by System.IO.Path.GetFileName(System.String), minus the last period (.) and all characters following it.
     */
    public static function getFileNameWithoutExtension($path) {
        if(self::containsInvalidPathChars($path)) throw new ArgumentException("path contains one or more of the invalid characters defined in System.IO.Path.GetInvalidPathChars.");
        $info = pathinfo($path);
        return is_file($path) ? $info["filename"] : "";
    }

    /**
     * Returns the absolute path for the specified path string.
     * @access public
     * @static
     * @throws ArgumentException|ArgumentNullException|PathTooLongException
     * @param string $path The file or directory for which to obtain absolute path information.
     * @return string A string containing the fully qualified location of path, such as "C:\MyFile.txt".
     */
    public static function getFullPath($path) {
        if(is_null($path)) throw new ArgumentNullException(" path is null.");
        if(self::containsInvalidPathChars($path) || strlen($path) == 0) throw new ArgumentException("path is a zero-length string, contains only white space, or contains one or more of the invalid characters defined in System.IO.Path.GetInvalidPathChars.");
        if(strlen($path) > 248) throw new PathTooLongException("The specified path, file name, or both exceed the system-defined maximum length. For example, on Windows-based platforms, paths must be less than 248 characters, and file names must be less than 260 characters.");
        return realpath($path);
    }

    /**
     * Gets an array containing the characters that are not allowed in file names.
     * @access public
     * @static
     * @return array An array containing the characters that are not allowed in file names.
     */
    public static function getInvalidFileNameChars() {
        return array('"', '<', '>', '|', '*');
    }


    /**
     * Gets an array containing the characters that are not allowed in path names.
     * @access public
     * @static
     * @return array An array containing the characters that are not allowed in path names.
     */
    public static function getInvalidPathChars()
    {
        return array('"', '<', '>', '|', '*');
    }


    /**
     * Gets the root directory information of the specified path.
     * @access public
     * @static
     * @throws ArgumentException
     * @param string $path The path from which to obtain root directory information.
     * @return string A string containing the root directory of path, such as "C:\", or null if path is null, or an empty string if path does not contain root directory information.
     */
    public static function getPathRoot($path) {
        if(self::containsInvalidPathChars($path) || strlen($path) == 0) throw new ArgumentException("path contains one or more of the invalid characters defined in System.IO.Path.GetInvalidPathChars. -or-  System.String.Empty was passed to path.");
        $directoryInfo = new DirectoryInfo($path);
        return $directoryInfo->root()->name();
    }

    /**
     * Returns a random folder name or file name.
     * @access public
     * @static
     * @return string A random folder name or file name.
     */
    public static function getRandomFileName() {
        return self::getRandomString(8).".".self::getRandomString(3);
    }

    /**
     * Creates a uniquely named, zero-byte temporary file on disk and returns the full path of that file.
     * @access public
     * @static
     * @throws IOException
     * @return string A String containing the full path of the temporary file. 
     */
    public static function getTempFileName()
    {
        try {
            $tmpPath =  self::getTempPath() . self::AltDirectorySeparatorChar . self::getRandomString(8) . '.tmp';
            Files::appendAllText($tmpPath, "");
            return $tmpPath;
        } catch(Exception $e) {
            throw new IOException("An I/O error occurs, such as no unique temporary file name is available.");
        }
    }

    /**
     * Returns the path of the current system's temporary folder.
     * @access public
     * @static
     * @return string A String containing the path information of a temporary directory.
     */
    public static function getTempPath() {
        return sys_get_temp_dir();
    }

    /**
     * Determines whether a path includes a file name extension.
     * @access public
     * @static
     * @throws ArgumentException
     * @param string $path The path to search for an extension.
     * @return bool true if the characters that follow the last directory separator (\\ or /) or volume separator (:) in the path include a period (.) followed by one or more characters; otherwise, false.
     */
    public static function hasExtension($path) {
        if(self::containsInvalidPathChars($path)) throw new ArgumentException("path contains one or more of the invalid characters defined in GetInvalidPathChars.");
        $info = pathinfo($path);
        return isset($info['extension']);
    }

    /**
     * Gets a value indicating whether the specified path string contains absolute or relative path information.
     * @access public
     * @static
     * @throws ArgumentException
     * @param string $path The path to test.
     * @return bool true if path contains an absolute path; otherwise, false.
     */
    public static function isPathRooted($path) {
        if(self::containsInvalidPathChars($path)) throw new ArgumentException("path contains one or more of the invalid characters defined in GetInvalidPathChars.");
        if(is_null($path)) return false;
        if($path[0] == self::DirectorySeparatorChar || $path[1] == self::VolumeSeparatorChar)
            return true;
        return false;
    }

    private static function getRandomString($size) {
        $characters = "0123456789abcdefghijklmnopqrstuvwxyz";
        $charactersSize = strlen($characters);
        $string = array();
        for ($index = 0; $index < $size; $index++) {
            array_push($string, $characters[mt_rand(0, $charactersSize)]);
        }
        return implode($string);
    }

    private static function containsInvalidPathChars($path) {
        $contains = false;
        $invalidCharacters = Path::getInvalidPathChars();
        for($i = 0; $i < sizeof($invalidCharacters) && !$contains; $i++) {
            if(strpos($path, $invalidCharacters[$i]) !== false)
                $contains = true;
        }
        return $contains;
    }
}
?>