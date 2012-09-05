<?php

namespace System\IO;

/**
 * Specifies how the operating system should open a file.
 * @access public
 * @name FileMode
 * @package System
 * @subpackage IO
 */
class FileMode {
    /**
     * Opens the file if it exists and seeks to the end of the file, or creates a new file. FileMode.Append can only be used in conjunction with FileAccess.Write. Attempting to seek to a position before the end of the file will throw an IOException and any attempt to read fails and throws an NotSupportedException.
     */
    const Append = "a";
    /**
     * Specifies that the operating system should create a new file. If the file already exists, it will be overwritten. This requires FileIOPermissionAccess.Write. System.IO.FileMode.Create is equivalent to requesting that if the file does not exist, use CreateNew; otherwise, use Truncate. If the file already exists but is a hidden file, an UnauthorizedAccessException is thrown.
     */
    const Create = "w";
    /**
     * Specifies that the operating system should create a new file. This requires FileIOPermissionAccess.Write. If the file already exists, an IOException is thrown.
     */
    const CreateNew = "x";
    /**
     * 	Specifies that the operating system should open an existing file. The ability to open the file is dependent on the value specified by FileAccess. A System.IO.FileNotFoundException is thrown if the file does not exist.
     */
    const Open = "r";
    /**
     * Specifies that the operating system should open a file if it exists; otherwise, a new file should be created. If the file is opened with FileAccess.Read, FileIOPermissionAccess.Read is required. If the file access is FileAccess.Write then FileIOPermissionAccess.Write is required. If the file is opened with FileAccess.ReadWrite, both FileIOPermissionAccess.Read and FileIOPermissionAccess.Write are required. If the file access is FileAccess.Append, then FileIOPermissionAccess.Append is required.
     */
    const OpenOrCreate = "r+";
    /**
     * Specifies that the operating system should open an existing file. Once opened, the file should be truncated so that its size is zero bytes. This requires FileIOPermissionAccess.Write. Attempts to read from a file opened with Truncate cause an exception.
     */
    const Truncate = "w+";
}

?>
