<?php

namespace System\Collections {

    use \System\Collections\DictionaryBase as DictionaryBase;
    use \System\Collections\IDictionary as IDictionary;


    class Dictionary extends DictionaryBase implements IDictionary {

        /**
         * Allows an Object to attempt to free resources and perform other cleanup operations before the Object is reclaimed by garbage collection. 
         *
         * @access protected
         * @return void
         */
        protected function finalize() { }
        

        /**
          * Performs additional custom processes before clearing the contents of the DictionaryBase instance. 
          *
          * @access protected
          */
         protected function onClear() { }


         /**
          * Performs additional custom processes after clearing the contents of the DictionaryBase instance. 
          * 
          * @access protected
         */ 
         protected function onClearComplete() { }


         /**
          * Gets the element with the specified key and value in the DictionaryBase instance.
          *
          * @access protected
         */
         protected function onGet($key, $currentValue) { }


         /**
          *  Performs additional custom processes before inserting a new element into the DictionaryBase instance. 
          *
          * @access protected
         */
         protected function onInsert($key, $value) { }


         /**
          *  Performs additional custom processes after inserting a new element into the DictionaryBase instance. 
          *
          * @access protected
         */
         protected function onInsertComplete($key, $value) { }


         /**
          * Performs additional custom processes before removing an element from the DictionaryBase instance.
          *
          * @access protected
         */
         protected function onRemove($key, $value) { }


         /**
          * Performs additional custom processes after removing an element from the DictionaryBase instance. 
          *
          * @access protected
         */
         protected function onRemoveComplete($key, $value) { }

         /**
          *  Performs additional custom processes before setting a value in the DictionaryBase instance. 
          * 
          * @access protected
         */
         protected function onSet($key, $oldValue, $newValue) { }

        /**
         * Performs additional custom processes after setting a value in the DictionaryBase instance. 
         *
         * @access protected
         */
         protected function onSetComplete($key, $oldValue, $newValue) { }

         /**
          * Performs additional custom processes when validating the element with the specified key and value. 
          *
          * @access protected
         */
         protected function onValidate($key, $value) { }

    }
}
