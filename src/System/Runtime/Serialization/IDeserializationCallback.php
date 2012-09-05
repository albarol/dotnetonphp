<?php

namespace System\Runtime\Serialization;

/**
 * Indicates that a class is to be notified when deserialization of the entire object graph has been completed.
 * @access public
 * @name IDeserializationCallback
 * @package System
 * @subpackage Runtime\Serialization
 */
interface IDeserializationCallback {

    /**
     * Runs when the entire object graph has been deserialized.
     * @abstract
     * @param $sender The object that initiated the callback. The functionality for this parameter is not currently implemented.
     * @return void
     */
    function onDeserialization($sender);
}
?>