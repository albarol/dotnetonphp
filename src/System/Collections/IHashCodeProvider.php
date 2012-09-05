<?php

namespace System\Collections;

/*
 * Supplies a hash code for an object, using a custom hash function.
 */
interface IHashCodeProvider {

    /*
     * Returns a hash code for the specified object.
     *
     * @param   The System.Object for which a hash code is to be returned.
     *
     * @return  A hash code for the specified object.
     */
    function getHashCode($obj);

}


?>
