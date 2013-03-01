<?php

namespace System\IO;

/**
 * Specifies whether to search the current directory, or the current directory and all subdirectories.
 * @access public
 * @name SearchOption
 * @package System
 * @subpackage IO
 */
final class SearchOption {

    /**
     * Includes the current directory and all the subdirectories in a search operation. This option includes reparse points like mounted drives and symbolic links in the search.
     */
    const AllDirectories = 1;
    /**
     * Includes only the current directory in a search.
     */
    const TopDirectoryOnly = 0;
}

?>
