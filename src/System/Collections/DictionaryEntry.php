<?php

namespace System\Collections;

/**
 * Defines a dictionary key/value pair that can be set or retrieved.
 * @access public
 * @name DictionaryEntry
 * @package System
 * @subpackage Collections
 */
class DictionaryEntry {

    /**
     * Gets or sets the key in the key/value pair.
     * @access public
     * @var object
     */
    public $key;

    /**
     * Gets or sets the value in the key/value pair.
     * @access public
     * @var object
     */
    public $value;

    /**
     * Initializes an instance of the System.Collections.DictionaryEntry type with the specified key and value.
     * @access public
     * @throws \System\ArgumentNullException
     * @param object $key The object defined in each key/value pair.
     * @param object $value The definition associated with key.
     */
    public function __construct($key, $value) {
        if(is_null($key)) throw new ArgumentNullException("key is null.");
        $this->key = $key;
        $this->value = $value;
    }
}
?>
