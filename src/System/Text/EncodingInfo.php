<?php

namespace System\Text;

/**
 * Provides basic information about an encoding.
 * @access public
 * @name EncodingInfo
 * @package System
 * @subpackage Text
 */
class EncodingInfo {

    private $codePage;
    private $displayName;
    private $name;


    /**
     * Initialize EncodingInfo
     * @param int $codePage
     * @param string $displayName
     * @param string $name
     */
    public function __construct($codePage,$displayName,$name) {
        $this->codePage = $codePage;
        $this->displayName = $displayName;
        $this->name = $name;
    }

    /**
     * Gets the code page identifier of the encoding.
     * @access public
     * @return int The code page identifier of the encoding.
     */
    public function codePage() {
        return $this->codePage;
    }

    /**
     * Gets the human-readable description of the encoding.
     * @access public
     * @return string The human-readable description of the encoding.
     */
    public function displayName() {
        return $this->displayName;
    }

    /**
     * Gets the name registered with the Internet Assigned Numbers Authority (IANA) for the encoding.
     * @access public
     * @return string The IANA name for the encoding. For more information about the IANA, see www.iana.org.
     */
    public function name() {
        return $this->name;
    }
}
