<?php

namespace System\Collections\Generic;

require_once('BaseEnumerator.php');

use \System\Collections\IDictionary as IDictionary;


/**
 * Enumerates the elements of a System.Collections.IDictionary.
 * @access public
 * @name DictionaryEnumerator
 * @package System
 * @subpackage Collections\Generic
 */
final class DictionaryEnumerator extends BaseEnumerator {

    public function __construct(IDictionary $dictionary) {
        foreach($dictionary->keys() as $key)
            $this->source[] = $dictionary->get($key);
    }
}
?>