<?php

namespace System\Collections;

class LinkedListNode {

    private $_value;
    private $_next;
    private $_previous;

    public function __construct($value,$previous=null,$next=null) {
        $this->_value = $value;
        $this->_next = $next;
        $this->_previous = $previous;
    }

    public function getValue() {
        return $this->_value;
    }

    public function getNext() {
        return $this->_next;
    }

    public function getPrevious() {
        return $this->_previous;
    }

    public function setNext($next) {
        $this->_next = $next;
    }

    public function setPrevious($previous) {
        $this->_previous = $previous;
    }
}
?>
