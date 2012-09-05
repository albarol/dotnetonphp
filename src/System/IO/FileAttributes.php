<?php

namespace System\IO;

/**
 * Provides attributes for files and directories.
 * @access public
 * @name FileAttributes
 * @package System
 * @subpackage IO
 */
class FileAttributes {
    /**
     * The file's archive status. Applications use this attribute to mark files for backup or removal.
     */
    const Archive = 32;
    /**
     * The file is compressed.
     */
    const Compressed = 2048;
    /**
     * Reserved for future use.
     */
    const Device = 64;
    /**
     * The file is a directory.
     */
    const Directory = 16;
    /**
     * The file or directory is encrypted. For a file, this means that all data in the file is encrypted. For a directory, this means that encryption is the default for newly created files and directories.
     */
    const Encrypted = 16384;
    /**
     * The file is hidden, and thus is not included in an ordinary directory listing.
     */
    const Hidden = 2;
    /**
     * The file is normal and has no other attributes set. This attribute is valid only if used alone.
     */
    const Normal = 128;
    /**
     * The file will not be indexed by the operating system's content indexing service.
     */
    const NotContentIndexed = 8192;
    /**
     * The file is offline. The data of the file is not immediately available.
     */
    const Offline = 4096;
    /**
     * The file is read-only.
     */
    const ReadOnly = 1;
    /**
     * The file contains a reparse point, which is a block of user-defined data associated with a file or a directory.
     */
    const ReparsePoint = 1024;
    /**
     * The file is a sparse file. Sparse files are typically large files whose data are mostly zeros.
     */
    const SparseFile = 512;
    /**
     * The file is a system file. The file is part of the operating system or is used exclusively by the operating system.
     */
    const System = 4;
    /**
     * The file is temporary. File systems attempt to keep all of the data in memory for quicker access rather than flushing the data back to mass storage. A temporary file should be deleted by the application as soon as it is no longer needed.
     */
    const Temporary = 256;
}
?>
