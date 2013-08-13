<?php

namespace System {

    use \System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;
    use \System\ArgumentNullException as ArgumentNullException;
    use \System\Char as Char;
    use \System\CharEnumerator as CharEnumerator;
    use \System\ICloneable as ICloneable;
    use \System\IConvertible as IConvertible;
    use \System\IComparable as IComparable;
    use \System\IEquatable as IEquatable;
    use \System\IFormatProvider as IFormatProvider;
    use \System\InvalidOperationException as InvalidOperationException;
    use \System\TypeCode as TypeCode;

    use \System\Collections\IEnumerable as IEnumerable;

    use \System\Text\NormalizationForm as NormalizationForm;

    /**
     * Represents text as a series of Unicode characters.
     * @access public
     * @package System
     * @name String
     * @final
     */
    final class String  implements ICloneable, IConvertible, IComparable, IEnumerable, IEquatable {

        private $value;
        private $readOnly;

        /**
         * Initializes a new instance of the String class.
         * @access public
         */
        public function __construct($value) { 
            $this->value = "".$value;
        }

        /**
         * Gets the character at a specified character position in this instance. 
         * @access public
         * @throws \System\ArgumentOutOfRangeException startIndex is less than zero. -or- startIndex specifies a position that is not within this string.
         * @param int $index A character position in this instance.
         * @return string This property returns the Char at the position specified by the index parameter. However, a Unicode character might be represented by more than one Char. Use the System.Globalization.StringInfo class to work with each Unicode character instead of each Char.
         */
        public function chars($index) {
            if ($index < 0):
                throw new ArgumentOutOfRangeException ("startIndex is less than zero.");
            elseif ($index > $this->length()):
                throw new ArgumentOutOfRangeException("startIndex specifies a position that is not within this string.");
            endif;
            return $this->value[$index];
        }

        /**
         * Concatenates two specified instances of String. 
         * @access public
         * @static
         * @param string $str0 The first String.
         * @param string $str1 The second String.
         * @return \System\String The concatenation of str0 and str1.
         */
        public static function concat($str0, $str1) {
            return new String($str0 . $str1);
        }

        /**
         * Returns a value indicating whether the specified System.String object occurs within this string.
         * @access public
         * @param string $value The System.String object to seek.
         * @return bool true if the value parameter occurs within this string, or if value is the empty string (""); otherwise, false.
        */
        public function contains($value) {
            return strpos($this->value, $value) !== false;
        }

        /**
         * Compares two specified String objects by evaluating the numeric values of the corresponding Char objects in each string.
         * @access public
         * @static
         * @param $strA The first String.
         * @param $strB The second String.
         * @return int An integer indicating the lexical relationship between the two comparands.
        */
        public static function compareOrdinal($strA, $strB) {
            $first = ($strA instanceof String) ? $strA->value() : $strA;
            $second = ($strB instanceof String) ? $strB->value() : $strB;
            return strcmp($first, $second);
        }

        /**
         * Compares this instance with a specified String object.
         * @access public
         * @param $strB A String.
         * @return int An integer indicating the lexical relationship between the two comparands.
        */
        public function compareTo($strB) {
            $first = ($strB instanceof String) ? $strB->value() : $strB;
            return strcmp($this->value, $first);
        }

        /**
         * Creates a new instance of String with the same value as a specified String.
         * @access public
         * @static
         * @param $str The String to copy.
         * @return \System\String A new String with the same value as str.
        */
        public static function copy(String $str) {
            return clone $str;
        }

        /**
         * Copies a specified number of characters from a specified position in this instance to a specified position in an array of Unicode characters.
         * @access public
         * @throws \System\ArgumentOutOfRangeException sourceIndex, destinationIndex, or count is negative -or- count is greater than the length of the substring from startIndex to the end of this instance -or- count is greater than the length of the subarray from destinationIndex to the end of destination.
         * @param int $sourceIndex A character position in this instance.
         * @param int $destinationIndex An array element in destination.
         * @param int $count The number of characters in this instance to copy to destination.
         * @return array An array of Unicode characters.
        */
        public function copyTo($sourceIndex=0, $destinationIndex=0, $count=0) {
            $destination = array();

            if($sourceIndex < 0 || $destinationIndex < 0 || $count < 0):
                throw new ArgumentOutOfRangeException("sourceIndex, destinationIndex, or count is negative.");
            endif;
            if(($sourceIndex + $count) > $this->length()):
                throw new ArgumentOutOfRangeException("count is greater than the length of the substring from startIndex to the end of this instance.");
            endif;
            
            for($i = 0; $i < $count; $i++):
                $destination[$destinationIndex + $i] = $this->chars($sourceIndex + $i);
            endfor;
            
            return $destination;
        }

        /**
         * Returns a reference to this instance of System.String.
         * @access public
         * @return \System\String This instance of String.
         */
        public function cloneObject() {
            return clone $this;
        }


        /**
         * Determines whether the end of this instance matches the specified string.
         * @throws \System\ArgumentNullException value is a null reference
         * @param string $value A String to compare to.
         * @return bool true if value matches the end of this instance; otherwise, false.
        */
        public function endsWith($value) {
            if($value instanceof String):
                return $this->endsWith($value->value());
            endif;
            $size = strlen($value);
            if ($size == 0) {
                return true;
            }
            return (substr($this->value, -$size) === $value);
        }

        /**
         * Determines whether two String objects have the same value.
         * @access public
         * @throws \System\ArgumentNullException 
         * @param $other Determines whether this instance of String and a specified object, which must also be a String object, have the same value.
         * @return bool true if obj is a String and its value is the same as this instance; otherwise, false.
        */
        public function equals($other) {
            return $this == $other;                
        }

        /**
         * Replaces the format item in a specified String with the text equivalent of the value of a specified Object instance.
         * @access public
         * @static
         * @throws \System\ArgumentNullException format or args is a null reference .
         * @throws \System\FormatException format is invalid. -or- The number indicating an argument to format is less than zero, or greater than or equal to the length of the args array.
         * @param string $format A String containing zero or more format items.
         * @param object $arg0 An Object array containing zero or more objects to format.
         * @param \System\IFormatProvider $format An IFormatProvider that supplies culture-specific formatting information.
         * @return string A copy of format in which the format items have been replaced by the String equivalent of the corresponding instances of Object in args.
         */
        public static function format($format, array $arg0, IFormatProvider $provider=null) {
            if (is_null($format) || sizeof($arg0) <= 0):
                throw new ArgumentNullException("format or args is a null reference.");
            endif;
            // TODO: implement 
        }

        /**
         * Returns an enumerator that iterates through a collection.
         * @access public
         * @return \System\Collections\IEnumerator An \System\Collections\IEnumerator object that can be used to iterate through the collection.
         */
        public function getEnumerator() {
            return new CharEnumerator($this->value);
        }

        /**
         * Represents the empty string. This field is read-only.
         * @static
         * @access public
         * @return \System\String The value of this field is the zero-length string, ""
         */
        public static function getEmpty() {
            return new String("");
        }

        /**
         * Returns the System.TypeCode for value type \System\String.
         * @return \System\TypeCode The enumerated constant, \System\TypeCode\Int32.
        */
        public function getTypeCode() {
            return TypeCode::string();
        }

        /**
         * Gets the number of characters in this instance.
         * @access public
         * @return int The number of characters in this instance.
         */
        public function length() {
            return mb_strlen($this->value, 'utf8');
        }
        
        /**
         * Reports the index of the first occurrence of a String, or one or more characters, within this string.
         * @access public
         * @throws \System\ArgumentOutOfRangeException startIndex or count is less than 0. -or- startIndex is greater than string length.
         * @param string $value A Unicode character to seek.
         * @param int $startIndex The search starting position.
         * @param int $count The number of character positions to examine.
         * @return int The index position of value if that character is found, or -1 if it is not.
         */
        public function indexOf($value, $startIndex = 0, $count = null) {
            if($value instanceof String):
                return $this->lastIndexOf($value->value(), $startIndex);
            endif;

            if ($startIndex < 0):
                throw new ArgumentOutOfRangeException("startIndex or count is less than 0.");
            elseif($startIndex > $this->length()):
                throw new ArgumentOutOfRangeException("startIndex is greater than string length.");
            elseif(($startIndex + $count) > $this->length()):
                throw new ArgumentOutOfRangeException("startIndex plus count is greater than value.");
            endif;

            $count = is_null($count) ? $this->length() - $startIndex : $count;
            $len = strlen($value);
            $position = -1;

            for($i = 0; $i < $count && $position == -1; $i++)
            {
                $current = $startIndex + $i;
                $substring = substr($this->value, $current, $len);
                if($value == $substring)
                {
                    $position = $startIndex + $i;
                }
            }
            
            return $position;
        }

        /**
         * Reports the index of the first occurrence in this instance of any character in a specified array of Unicode characters. The search starts at a specified character position and examines a specified number of character positions.
         * @access public
         * @throws \System\ArgumentOutOfRangeException startIndex is negative.
         * @param array $anyOf A Unicode character array containing one or more characters to seek.
         * @param int $startIndex The search starting position.
         * @return int The index position of the first occurrence in this instance where any character in anyOf was found; otherwise, -1 if no character in anyOf was found.
        */
        public function indexOfAny(array $anyOf, $startIndex = 0) {
            $word = implode($anyOf, "");
            return $this->indexOf($word, $startIndex);
        }

        /**
         * Inserts a specified instance of String at a specified index position in this instance.
         * @access public
         * @throws \System\ArgumentNullException value is a null reference
         * @throws \System\ArgumentOutOfRangeException startIndex is negative or greater than the length of this instance.
         * @param int $startIndex The index position of the insertion.
         * @param string $value The String to insert.
         * @return \System\String A new String equivalent to this instance but with value inserted at position startIndex.
        */
        public function insert($startIndex, $value) {
            if (is_null($value)):
                throw new ArgumentNullException("");
            endif;
            if ($startIndex < 0 || $startIndex > $this->length()):
                throw new ArgumentOutOfRangeException("");
            endif;

            $first_part = substr($this->value, 0, $startIndex);
            $second_part = substr($this->value, $startIndex + 1, $this->length());
            return new String($first_part.$value.$second_part);
        }

        /** 
         * Indicates whether this string is in the specified Unicode normalization form.
         * @access public
         * @throws \Exception string cant be normalized
         * @param \System\Text\NormalizationForm $normalizationForm A Unicode normalization form.
         * @return bool true if this string is in the normalization form specified by the normalizationForm parameter; otherwise, false.
        */
        public function isNormalized(NormalizationForm $normalizationForm = null) {
            if(!class_exists("\\Normalizer")):
                throw new \Exception("InvalidOperationException");
            endif;

            if (is_null($normalizationForm)):
                $normalizationForm = NormalizationForm::formC();
            endif;

            return \Normalizer::isNormalized($this->value, $normalizationForm->value());
        }

        /**
         * Indicates whether the specified String object is a null reference or an Empty string.
         * @access public
         * @static
         * @param string $string A String reference.
         * @return bool true if the value parameter is a null reference or an empty string (""); otherwise, false.
         */
        public static function isNullOrEmpty($string) {
            if($string instanceof String):
                return self::isNullOrEmpty($string->value());
            endif;                    
            return is_null($string) || empty($string);
        }

        /**
         * Concatenates a specified separator String between each element of a specified String array, yielding a single concatenated string. Parameters specify the first array element and number of elements to use.
         * @access public
         * @static
         * @throws \System\ArgumentOutOfRangeException startIndex or count is less than 0. -or- startIndex plus count is greater than the number of elements in value.
         * @param string $separator A String.
         * @param array $value An array of String.
         * @param int $startIndex The first array element in value to use.
         * @param int $count The number of elements of value to use.
         * @return \System\String A String object consisting of the strings in value joined by separator. Or, Empty if count is zero, value has no elements, or separator and all the elements of value are Empty.
        */
        public static function join($separator, array $value, $startIndex = 0, $count = null) {
            if ($startIndex < 0):
                throw new ArgumentOutOfRangeException("startIndex or count is less than 0.");
            elseif (($startIndex + $count) > sizeof($value)):
                throw new ArgumentOutOfRangeException("startIndex plus count is greater than the number of elements in value.");
            endif;
            
            $count = is_null($count) ? sizeof($value) - $startIndex : $count;
            $str = array_slice($value, $startIndex, $count);
            return new String(implode($separator, $str));
        }

        /**
         * Reports the index position of the last occurrence of a specified String within this instance. The search starts at a specified character position.
         * @access public
         * @throws \System\ArgumentOutOfRangeException startIndex is greater than string length. -or- startIndex or count is less than 0.
         * @param string $value The String to seek.
         * @param int $startIndex The search starting position.
         * @param int $count The number of character positions to examine.
         * @return int The index position of value if that string is found, or -1 if it is not. If value is Empty, the return value is startIndex.
        */
        public function lastIndexOf($value, $startIndex = 0, $count = null) {
            if($value instanceof String):
                return $this->lastIndexOf($value->value(), $startIndex);
            endif;

            if ($startIndex < 0):
                throw new ArgumentOutOfRangeException("startIndex or count is less than 0.");
            elseif($startIndex > $this->length()):
                throw new ArgumentOutOfRangeException("startIndex is greater than string length.");
            elseif(($startIndex + $count) > $this->length()):
                throw new ArgumentOutOfRangeException("startIndex plus count is greater than value.");
            endif;

            $count = is_null($count) ? $this->length() - $startIndex : $count;
            $len = strlen($value);
            $position = -1;

            for($i = 0; $i < $count; $i++)
            {
                $current = $startIndex + $i;
                $substring = substr($this->value, $current, $len);
                if($value == $substring)
                {
                    $position = $startIndex + $i;
                }
            }
            
            return $position;
        }

        /**
         * Reports the index position of the last occurrence in this instance of one or more characters specified in a Unicode array. The search starts at a specified character position.
         * @access public
         * @throws \System\ArgumentOutOfRangeException startIndex specifies a position not within this instance.
         * @param array $value A Unicode character array containing one or more characters to seek.
         * @param int $startIndex The search starting position.
         * @return int The index position of the last occurrence in this instance where any character in anyOf was found; otherwise, -1 if no character in anyOf was found.
        */
        public function lastIndexOfAny(array $value, $startIndex = 0) {
            $word = implode("", $value);
            return $this->lastIndexOf($word, $startIndex);
        }


        /**
         * Returns a new string whose textual value is the same as this string, but whose binary representation is in the specified Unicode normalization form.
         * @access public
         * @param \System\Text\NormalizationForm $normalizationForm A Unicode normalization form.
         * @return \System\String A new string whose textual value is the same as this string, but whose binary representation is in the normalization form specified by the normalizationForm parameter.
        */ 
        public function normalize(NormalizationForm $normalizationForm = null) {
            if(!class_exists("\\Normalizer")):
                throw new InvalidOperationException("NotSupportedOperation");
            endif;

            if (is_null($normalizationForm)):
                $normalizationForm = NormalizationForm::formC();
            endif;

            $str_normalized = normalizer_normalize($this->value, $normalizationForm->value());
            return new String($str_normalized);
        }

        /**
         * Right-aligns the characters in this instance, padding on the left with a specified Unicode character for a specified total length.
         * @access public
         * @throws \System\ArgumentException totalWidth is less than zero. 
         * @param int $totalWidth The number of characters in the resulting string, equal to the number of original characters plus any additional padding characters.
         * @param string $paddingChar A Unicode padding character.
         * @return A new String that is equivalent to this instance, but right-aligned and padded on the left with as many paddingChar characters as needed to create a length of totalWidth. Or, if totalWidth is less than the length of this instance, a new String that is identical to this instance.
        */
        public function padLeft($totalWidth, $paddingChar = " ") {
            return $this->padding($totalWidth, $paddingChar, STR_PAD_LEFT);
        }

        /**
         * Left-aligns the characters in this string, padding on the right with spaces or a specified Unicode character, for a specified total length.
         * @access public
         * @throws \System\ArgumentException totalWidth is less than zero. 
         * @param int $totalWidth The number of characters in the resulting string, equal to the number of original characters plus any additional padding characters.
         * @param string $paddingChar A Unicode padding character.
         * @return A new String that is equivalent to this instance, but right-aligned and padded on the left with as many paddingChar characters as needed to create a length of totalWidth. Or, if totalWidth is less than the length of this instance, a new String that is identical to this instance.
        */
        public function padRight($totalWidth, $paddingChar = " ") {
            return $this->padding($totalWidth, $paddingChar, STR_PAD_RIGHT);
        }

        private function padding($totalWidth, $paddingChar, $position) {
            if ($totalWidth < 0):
                throw new ArgumentException("totalWidth is less than zero.");
            endif;
            $str_spaced = str_pad($this->value, $totalWidth, $paddingChar, $position); 
            return new String($str_spaced);    
        }

        /**
         * Deletes all the characters from this string beginning at a specified position and continuing through the last position.
         * @access public
         * @param int startIndex The zero-based position to begin deleting characters.
         * @return \System\String A new System.String object that is equivalent to this string less the removed characters.
         */
        public function remove($startIndex) {
            if ($startIndex < 0):
                throw new ArgumentOutOfRangeException ("startIndex is less than zero.");
            elseif ($startIndex > $this->length()):
                throw new ArgumentOutOfRangeException("startIndex specifies a position that is not within this string.");
            endif;
            return new String(substr($this->value, 0, $startIndex));
        }

        /**
         * Replaces all occurrences of a specified Unicode character or String in this instance, with another specified Unicode character or String. 
         * @access public
         * @throws \System\ArgumentNullException value is null.
         * @throws \System\ArgumentException value is empty.
         * @param string $oldValue A \System\String to be replaced.
         * @param string $newValue A \System\String to replace all occurrences of oldValue.
         * @return \System\String A System.String equivalent to this instance but with all instances of oldValue replaced with newValue.
         */
        public function replace($oldValue, $newValue) {
            if ($oldValue == null):
                throw new ArgumentNullException("value is null.");
            elseif (self::isNullOrEmpty($oldValue)):
                throw new ArgumentException("value is empty. -or- value is");
            endif;
            return new String(str_replace($oldValue, $newValue, $this->value()));
        }

        /**
         * Copies the characters in this instance to a Unicode character array.
         * @access public
         * @return array A Unicode character array whose elements are the individual characters of this instance. If this instance is an empty string, the returned array is empty and has a zero length.
         */
        public function toCharArray() {
            return str_split($this->value);
        }

        /**
         * Returns a copy of this \System\String converted to lowercase, using the casing rules of the current culture.
         * @access public
         * @return \System\String A \System\String in lowercase.
         */
        public function toLower() {
            return new String(strtolower($this->value));
        }

        /**
         * Returns a copy of this System.String converted to uppercase, using the casing rules of the current culture.
         * @access public
         * @return \System\String A System.String in uppercase.
         */
        public function toUpper() {
            return new String(strtoupper($this->value));
        }

        /**
         * Removes all leading and trailing white-space characters from the current System.String object.
         * @access public
         * @param array $trimChars An array of Unicode characters to be removed
         * @return \System\String The string that remains after all white-space characters are removed from the start and end of the current System.String object.
         */
        public function trim(array $trimChars = array(' ')) {
            $charlist = implode($trimChars);
            return new String(trim($this->value, $charlist));
        }

        /**
         * Removes all occurrences of a set of characters specified in an array from the end of this instance.
         * @access public
         * @param array $trimChars An array of Unicode characters to be removed
         * @return \System\String The String that remains after all occurrences of characters in trimChars are removed from the beginning. 
        */
        public function trimEnd(array $trimChars = array(' ')) {
            $charlist = implode($trimChars);
            return new String(rtrim($this->value, $charlist));
        }

        /**
         * Removes all occurrences of a set of characters specified in an array from the beginning of this instance.
         * @access public
         * @param array $trimChars An array of Unicode characters to be removed
         * @return \System\String The String that remains after all occurrences of characters in trimChars are removed from the beginning. 
        */
        public function trimStart(array $trimChars = array(' ')) {
            $charlist = implode($trimChars);
            return new String(ltrim($this->value, $charlist));
        }

        /**
         * Get or set string value
         * @access public
         * @param string $value string value
         * @return string string value
        */
        public function value($value = null) {
            if($value instanceof String):
                $this->value = $value->value();
            elseif(!is_null($value)):
                $this->value = "".$value;
            endif;
            return $this->value;
        }

        public function __toString() {
            return $this->value;
        }
        

        /**
         * Converts the value of this instance to an equivalent Boolean value using the specified culture-specific formatting information.
         *
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Boolean A Boolean value equivalent to the value of this instance.
         */
        function toBoolean(IFormatProvider $provider = null) { }


        /**
         * Converts the value of this instance to an equivalent 8-bit unsigned integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Byte An 8-bit unsigned integer equivalent to the value of this instance.
         */
        function toByte(IFormatProvider $provider = null) { }

        /**
         * Converts the value of this instance to an equivalent Unicode character using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Char A Unicode character equivalent to the value of this instance.
         */
        function toChar(IFormatProvider $provider = null) { }

        /**
         * Converts the value of this instance to an equivalent System.DateAndTime using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\DateTime A System.DateTime instance equivalent to the value of this instance.
         */
        function toDateTime(IFormatProvider $provider = null) { }

        /**
         * Converts the value of this instance to an equivalent System.Decimal number using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return Decimal A System.Decimal number equivalent to the value of this instance.
         */
        function toDecimal(IFormatProvider $provider = null) { }

        /**
         * Converts the value of this instance to an equivalent double-precision floating-point number using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Double A double-precision floating-point number equivalent to the value of this instance.
         */
        function toDouble(IFormatProvider $provider = null) { }

        /**
         * Converts the value of this instance to an equivalent 16-bit signed integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Int16 An 16-bit signed integer equivalent to the value of this instance.
         */
        function toInt16(IFormatProvider $provider = null) { }

        /**
         * Converts the value of this instance to an equivalent 32-bit signed integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Int32 An 32-bit signed integer equivalent to the value of this instance.
         */
        function toInt32(IFormatProvider $provider = null) { }

        /**
         * Converts the value of this instance to an equivalent 64-bit signed integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Int64 An 64-bit signed integer equivalent to the value of this instance.
         */
        function toInt64(IFormatProvider $provider = null) { }


        /**
         * Converts the value of this instance to an equivalent 8-bit signed integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\SByte An 8-bit signed integer equivalent to the value of this instance.
         */
        function toSByte(IFormatProvider $provider = null) { }


        /**
         * Converts the value of this instance to an equivalent single-precision floating-point number using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\Single A single-precision floating-point number equivalent to the value of this instance.
         */
        function toSingle(IFormatProvider $provider = null) { }

        /**
         * Converts the value of this instance to an System.Object of the specified System.Type that has an equivalent value, using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\Type $conversionType The System.Type to which the value of this instance is converted.
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return Type An System.Object instance of type conversionType whose value is equivalent to the value of this instance.
         */
        function toType(Type $conversionType, IFormatProvider $provider = null) { }

        /**
         * Converts the value of this instance to an equivalent 16-bit unsigned integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\UInt16 An 16-bit unsigned integer equivalent to the value of this instance.
         */
        function toUInt16(IFormatProvider $provider = null) { }

        /**
         * Converts the value of this instance to an equivalent 32-bit unsigned integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\UInt32 An 32-bit unsigned integer equivalent to the value of this instance.
         */
        function toUInt32(IFormatProvider $provider = null) { }

        /**
         * Converts the value of this instance to an equivalent 64-bit unsigned integer using the specified culture-specific formatting information.
         *
         * @access public
         * @param \System\IFormatProvider $provider An System.IFormatProvider interface implementation that supplies culture-specific formatting information.
         * @return \System\UInt64 An 64-bit unsigned integer equivalent to the value of this instance.
         */
        function toUInt64(IFormatProvider $provider = null) { }
   }
}
