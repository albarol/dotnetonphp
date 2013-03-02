<?php

namespace System\IO {

    use \System\IO\TextReader as TextReader;
    use \System\ObjectDisposedException as ObjectDisposedException;
    use \System\ArgumentNullException as ArgumentNullException;

    /**
     * Implements a TextReader that reads from a string.
     * @access public
     * @name StringReader
     * @package System
     * @subpackage IO
     */
    class StringReader extends TextReader {

        private $breakLine = "\r\n";
        private $line = 0;
        private $character = 0;

        /**
         * Initializes a new instance of the StringReader class that reads from the specified string.
         * @throws ArgumentNullException
         * @param $s The string to which the StringReader should be initialized.
         */
        public function __construct($s) {
            if(is_null($s)) throw new ArgumentNullException("The s parameter is Nothing.");
            $this->resource = explode($this->breakLine, $s);
        }

        /**
         * Performs application-defined tasks associated with freeing, releasing, or resetting unmanaged resources.
         * @access public
         * @return void
         */
        function dispose() {
            $this->close();
        }

        /**
         * Reads the next character without changing the state of the reader or the character source. Returns the next available character without actually reading it from the input stream.
         * @access public
         * @return int An integer representing the next character to be read, or -1 if no more characters are available or the stream does not support seeking.
         */
        public function peek() {
            if(!isset($this->resource)) throw new ObjectDisposedException("The current reader is closed.");
            $current_content = $this->getCurrentLine();
            return $current_content[$this->character];
        }

        /**
         * Reads the next character from the input stream and advances the character position by one character.
         * @access public
         * @throws ArgumentNullException|ArgumentException|ArgumentOutOfRangeException|ObjectDisposedException|IOException
         * @param array $buffer When this method returns, contains the specified character array with the values between index and (index + count - 1) replaced by the characters read from the current source.
         * @param int $index The place in buffer at which to begin writing.
         * @param int $count The maximum number of characters to read. If the end of the stream is reached before count of characters is read into buffer, the current method returns.
         * @return int The number of characters that have been read. The number will be less than or equal to count, depending on whether the data is available within the stream. This method returns zero if called when no more characters are left to read.
         */
        public function read($index=null, $count=null) {
            if(!isset($this->resource)) throw new ObjectDisposedException("The current reader is closed.");
            if(sizeof($buffer) == 0 && is_null($index))
                return $this->readOnlyCharacter();
            return $this->readBlock($index, $count);
        }


         /**
         * Read next character
         * @access protected
         * @return string
         */
        protected function readOnlyCharacter() {
            $current_content = $this->getCurrentLine();
            if($this->character >= strlen($current_content)) {
                $current_content = $this->resource[++$this->line];
                $this->character = 0;
            }
            
            return array(
                'buffer' => $current_content[$this->character++],
                'count'  => 1
            );
        }


        /**
         * Reads a maximum of count characters from the current stream, and writes the data to buffer, beginning at index.
         * @access public
         * @throws ArgumentNullException|ArgumentException|ArgumentOutOfRangeException|ObjectDisposedException|IOException
         * @param array $buffer When this method returns, contains the specified character array with the values between index and (index + count - 1) replaced by the characters read from the current source.
         * @param $index The place in buffer at which to begin writing.
         * @param $count The maximum number of characters to read. If the end of the stream is reached before count of characters is read into buffer, the current method returns.
         * @return int The position of the underlying stream is advanced by the number of characters that were read into buffer.
         */
        public function readBlock($index=0, $count=0) {
            $buffer = array();
            $copy_area_size = $index + $count;

            if(!isset($this->resource)) throw new ObjectDisposedException("The current reader is closed.");
            for($i = $index; $i < $copy_area_size; $i++):
                array_push($buffer, $this->readOnlyCharacter());
            endfor;
            
            return array(
                'buffer' => $count,
                'count'  => 1
            );
        }

        /**
         * Reads a line of characters from the current stream and returns the data as a string.
         * @access public
         * @throws IOException|OutOfMemoryException|ObjectDisposedException|ArgumentOutOfRangeException
         * @return string The next line from the input stream, or null if all characters have been read.
         */
        public function readLine() {
            if(!isset($this->resource)) throw new ObjectDisposedException("The current reader is closed.");
            return isset($this->resource[$this->line]) ? $this->resource[$this->line++] : "";
        }

        /**
         * Reads all characters from the current position to the end of the TextReader and returns them as one string.
         * @access public
         * @throws IOException|ObjectDisposedException|OutOfMemoryException|ArgumentOutOfRangeException
         * @return string A string containing all characters from the current position to the end of the TextReader.
         */
        public function readToEnd() {
            if(!isset($this->resource)) throw new ObjectDisposedException("The current reader is closed.");
            $array = array();
            for($i = $this->line; $i < sizeof($this->resource); $i++)
                array_push($array, $this->readLine());
            return implode("\r\n", $array);
        }


        private function getCurrentLine() {
            return $this->resource[$this->line];
        }

    }
}
