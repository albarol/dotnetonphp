<?php

/**
 * Represents additional options for creating a System.IO.FileStream object.
 * @access public
 * @name FileOptions
 * @package System
 * @subpackage IO
 */
final class FileOptions {
    /**
     * Indicates that a file can be used for asynchronous reading and writing.
     */
    const Asynchronous = 1073741824;

    /**
     * Indicates that a file is automatically deleted when it is no longer in use.
     */
    const DeleteOnClose = 67108864;

    /**
     * Indicates that a file is encrypted and can be decrypted only by using the same user account used for encryption.
     */
    const Encrypted = 16384;

    /**
     * Indicates no additional parameters.
     */
    const None = 0;

    /**
     * Indicates that the file is accessed randomly. The system can use this as a hint to optimize file caching.
     */
    const RandomAccess = 268435456;

    /**
     * Indicates that the file is to be accessed sequentially from beginning to end. The system can use this as a hint to optimize file caching. If an application moves the file pointer for random access, optimum caching may not occur; however, correct operation is still guaranteed.
     */
    const SequentialScan = 134217728;

    /**
     * Indicates that the system should write through any intermediate cache and go directly to disk.
     */
    const WriteThrough = -2147483648;
}
?>
