<?php

 /**
  * Creates and controls a thread, sets its priority, and gets its status.
  * @access public
  * @name Thread
  * @final
  * @package System
  * @subpackage Threading
  */
final class Thread {

    /**
     * Gets the currently running thread.
     * @static
     * @return Thread Gets the currently running thread.
     */
    public static function currentThread(){
        return new Thread;
    }

}

?>
