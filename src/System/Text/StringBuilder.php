<?php

namespace System\Text;

require_once(dirname(__FILE__) . "/../String.php");
require_once(dirname(__FILE__) . "/../ArgumentNullException.php");
require_once(dirname(__FILE__) . "/../ArgumentOutOfRangeException.php");
require_once(dirname(__FILE__) . "/../IndexOutOfRangeException.php");
require_once(dirname(__FILE__) . "/../runtime/serialization/ISerializable.php");


use \System\Runtime\Serialization\ISerializable as ISerializable;




/**
 * Represents a mutable string of characters. This class cannot be inherited.
 * @access public
 * @name StringBuilder
 * @package System
 * @subpackage Text
 */
final class StringBuilder implements ISerializable {

    private $result;
    private $maxCapacity;
    private $actualCapacity;

    /**
     * Initializes a new instance of the System.Text.StringBuilder class using the specified capacity.
     * @access public
     * @param int $maxCapacity The suggested starting size of this instance.
     */
    public function  __construct($maxCapacity=2147483647) {
        $this->result = array();
        $this->maxCapacity = $maxCapacity;
    }

    /**
     * Appends a copy of a specified substring to the end of this instance.
     * @throws ArgumentOutOfRangeException|ArgumentNullException
     * @param string $value The System.String that contains the substring to append.
     * @param int $startIndex The starting position of the substring within value.
     * @param int $count The number of characters in value to append.
     */
    public function append($value, $startIndex=null, $count=0) {
        if(is_null($startIndex)) {
            $this->addElement($value);
        } else {
            $this->appendSubstring($value, $startIndex, $count);
        }
    }


    /**
     * Appends a formatted string, which contains zero or more format specifications, to this instance. Each format specification is replaced by the string representation of a corresponding object argument.
     * @throws ArgumentNullException|FormatException|ArgumentOutOfRangeException
     * @param String $format A composite format string.
     * @param String $args An array of objects to format.
     */
    public function appendFormat($format,$args) {
        if($format == null || $args == null) throw new ArgumentNullException("format or args is null.");
        for($i = 0; $i <= sizeof($args); $i++)
            $format = str_replace("{".$i."}", $args[$i], $format);
        $this->append($format);
    }

    /**
     * Appends a copy of the specified string and the default line terminator to the end of the current System.Text.StringBuilder object.
     * @access public
     * @param string $value The System.String to append.
     */
    public function appendLine($value="") {
        $this->addElement("$value\r\n");
    }

    /**
     * Gets or sets the maximum number of characters that can be contained in the memory allocated by the current instance.
     * @access public
     * @param int $value Set the maximum number of characters to the current instance.
     * @return int gets the maximum number of characters allocated by the current instance.
     */
    public function capacity($value=null) {
        if(is_int($value)) {
            if($value < 0 || $value < $this->length() || $value > $this->maxCapacity) throw new ArgumentOutOfRangeException("capacity is less than zero. -or - The value specified for a set operation is less than the current length of this instance. -or- The value specified for a set operation is greater than the maximum capacity.");
            $this->actualCapacity = $value;
        }
        return $this->actualCapacity;
    }


    /**
     * Copies the characters from a specified segment of this instance to a specified segment of a destination System.Char array.
     * @access public
     * @throws ArgumentNullException|ArgumentOutOfRangeException|ArgumentException
     * @param int $sourceIndex The starting position in this instance where characters will be copied from. The index is zero-based.
     * @param int $destination The System.Char array where characters will be copied to.
     * @param int $destinationIndex The starting position in destination where characters will be copied to. The index is zero-based.
     * @param int $count The number of characters to be copied.
     */
    public function copyTo($sourceIndex, &$destination, $destinationIndex, $count) {
        if(is_null($destination)) throw new ArgumentNullException("destination is null.");
        if($sourceIndex < 0 || $destinationIndex < 0 || $count < 0 || $sourceIndex > $this->length()) throw new ArgumentOutOfRangeException("sourceIndex, destinationIndex, or count, is less than zero.  -or-  sourceIndex is greater than the length of this instance.");
        if(($sourceIndex + $count > $this->length()) || ($destinationIndex + $count > sizeof($destination))) throw new ArgumentException("sourceIndex + count is greater than the length of this instance. -or- destinationIndex + count is greater than the length of destination.");

        $source = str_split($this->toString());
        for($i = 0; $i < $count; $i++)
            $destination[$destinationIndex + $i] = $source[$sourceIndex + $i];
    }

    /**
     * Ensures that the capacity of this instance of System.Text.StringBuilder is at least the specified value.
     * @throws ArgumentOutOfRangeException
     * @param int $capacity The minimum capacity to ensure.
     * @return int The new capacity of this instance.
     */
    public function ensureCapacity($capacity) {
        if($this->actualCapacity < $capacity)
            $this->capacity($capacity);
        return $this->actualCapacity;
    }


    /**
     * Inserts the string representation of a specified subarray of Unicode characters into this instance at the specified character position.
     * @access public
     * @throws ArgumentOutOfRangeException
     * @param int $index The position in this instance where insertion begins.
     * @param object $value A character array.
     */
    public function insert($index, $value) {
        if($this->isInvalidIndex($index)) throw new ArgumentOutOfRangeException("index is less than zero or greater than the current length of this instance.");
        $this->addElement($value, $index);
    }


    /**
     * Gets the maximum capacity of this instance.
     * @access public
     * @return int The maximum number of characters this instance can hold.
     */
    public function maxCapacity() {
        return $this->maxCapacity;
    }


    /**
     * Gets or sets the length of the current System.Text.StringBuilder object.
     * @access public
     * @param int $size
     * @return int The length of this instance.
     */
    public function length($size=null) {
        if(is_int($size)) {
            if($size < 0 || $size > sizeof($this->result) || $size > $this->maxCapacity) throw new ArgumentOutOfRangeException("The value specified for a set operation is less than zero or greater than System.Text.StringBuilder.MaxCapacity.");
            array_splice($this->result, $size);
        }
        return sizeof($this->result);
    }

    /**
     * Removes the specified range of characters from this instance.
     * @access public
     * @param int $startIndex The zero-based position in this instance where removal begins.
     * @param int $length The number of characters to remove.
     * @return A reference to this instance after the excise operation has completed.
     */
    public function remove($startIndex, $length) {
        if($this->isInvalidRange($startIndex, $length)) throw new ArgumentOutOfRangeException("If startIndex or length is less than zero, or startIndex + length is greater than the length of this instance.");
        $before = clone $this;

        for($i = 0; $i < $length; $i++)
            unset($this->result[$startIndex + $i]);
        $this->result = array_values($this->result);
        $this->capacity($this->length());
        return $before;
    }

    /**
     * Replaces all occurrences of a specified character in this instance with another specified character.
     * @param $oldChar The character to replace.
     * @param $newChar The character that replaces oldChar.
     * @param $startIndex The position in this instance where the substring begins.
     * @param $count The length of the substring.
     * @return A reference to this instance with oldChar replaced by newChar.
     */
    public function replace($oldChar, $newChar, $startIndex=null, $count=null) {
        $length = $this->length();

        if(is_int($startIndex) && is_int($count)) {
            if($this->isInvalidRange($startIndex, $count)) throw new ArgumentOutOfRangeException("If startIndex or length is less than zero, or startIndex + length is greater than the length of this instance.");
            $position = $startIndex;
            $length = $count;
        }
        $before = clone $this;
        for($i = 0; $i < $length; $i++) {
            if($this->result[$position + $i] == $oldChar)
                $this->result[$position + $i] = $newChar;
        }
        return $before;
    }

    /**
     * Gets the character at the specified character position in this instance.
     * @access public
     * @param $index The position of the character.
     * @return The Unicode character at position index.
     */
    public function get($index) {
        if($this->isInvalidIndex($index)) throw new IndexOutOfRangeException("index is outside the bounds of this instance while get -or- setting a character. ");
        return $this->result[$index];
    }

    /**
     * Converts the value of this instance to a System.String.
     * @access public
     * @return A string whose value is the same as this instance.
     */
    public function toString() {
        return implode($this->result);
    }

    public function getObjectData($info, $context) {

    }
    
    private function addElement($value, $index=null) {
        if(is_null($value)) throw new ArgumentNullException("value is null, and startIndex and count are not zero.");
        if(is_null($index)) {
            $this->result = array_merge($this->result, str_split($value));
        } else {
            array_splice($this->result, $index, 0, str_split($value));
        }
        $this->capacity($this->length());
    }

    private function appendSubstring($value, $startIndex, $count) {
        if($count < 0 || $startIndex < 0 || (strlen($value) < $startIndex + $count)) throw new ArgumentOutOfRangeException ("count less than zero. -or- startIndex less than zero.  -or- startIndex + count is greater than the length of value.");
        ($count == 0) ? $this->addElement(substr($value, $startIndex)) : $this->addElement(substr($value, $startIndex, $count));
    }

    private function isInvalidRange($startIndex, $length) {
        return $startIndex < 0 || $length < 0 || ($startIndex + $length) > $this->length();
    }

    private function isInvalidIndex($index) {
        return $index < 0 || $index > $this->length();
    }
}
?>
