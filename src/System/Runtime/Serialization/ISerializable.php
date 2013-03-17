<?php

namespace System\Runtime\Serialization
{
   /**
     * Allows an object to control its own serialization and deserialization.
     * @package System
     * @subpackage Runtime\Serialization
     * @name ISerializable
     */
    interface ISerializable {

        /**
         * Populates a System.Runtime.Serialization.SerializationInfo with the data needed to serialize the target object.
         * @access public
         * @throws System.Security.SecurityException: The caller does not have the required permission.
         * @param SerializationInfo $info The System.Runtime.Serialization.SerializationInfo to populate with data.
         * @param StreamingContext $context The destination for this serialization.
         */
        function getObjectData($info, $context);
    }
}
