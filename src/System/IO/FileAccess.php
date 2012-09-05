<?php

namespace System\IO;

/**
 * Defines constants for read, write, or read/write access to a file.
 * @name FileAccess
 * @access public
 * @package System
 * @subpackage IO
 */
final class FileAccess {
    /**
     * Read access to the file. Data can be read from the file. Combine with Write for read/write access.
     */
    const Read = 1;
    /**
     * Write access to the file. Data can be written to the file. Combine with Read for read/write access.
     */
    const Write = 2;
    /**
     * Read and write access to the file. Data can be written to and read from the file. 
     */
    const ReadWrite = 3;
}
?>