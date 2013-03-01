<?php

namespace System\IO;

/**
 * Provides the fields that represent reference points in streams for seeking.
 * @access public
 * @name SeekOrigin
 * @package System
 * @subpackage IO
 */
final class SeekOrigin {
    /**
     * Specifies the beginning of a stream.
     */
    const Begin = 0;

    /**
     * 	Specifies the current position within a stream.
     */
    const Current = 1;

    /**
     * Specifies the end of a stream.
     */
    const End = 2;
}
?>