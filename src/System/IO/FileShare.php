<?php

namespace System\IO;

/**
 * Contains constants for controlling the kind of access other FileStream objects can have to the same file.
 * @access public
 * @name FileShare
 * @package System
 * @subpackage IO
 */
final class FileShare {
    /**
     * Declines sharing of the current file. Any request to open the file (by this process or another process) will fail until the file is closed.
     */
    const None = 0;
    /**
     * Allows subsequent opening of the file for reading. If this flag is not specified, any request to open the file for reading (by this process or another process) will fail until the file is closed. However, even if this flag is specified, additional permissions might still be needed to access the file.
     */
    const Read = 1;
    /**
     * Allows subsequent opening of the file for writing. If this flag is not specified, any request to open the file for writing (by this process or another process) will fail until the file is closed. However, even if this flag is specified, additional permissions might still be needed to access the file.
     */
    const Write = 2;
    /**
     * Allows subsequent opening of the file for reading or writing. If this flag is not specified, any request to open the file for reading or writing (by this process or another process) will fail until the file is closed. However, even if this flag is specified, additional permissions might still be needed to access the file.
     */
    const ReadWrite = 3;
    /**
     * Allows subsequent deleting of a file.
     */
    const Delete = 4;
    /**
     * Makes the file handle inheritable by child processes. This is not directly supported by Win32.
     */
    const Inheritable = 16;
}
?>
