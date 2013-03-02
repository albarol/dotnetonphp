<?php

namespace System\IO {

    use \System\ArgumentNullException as ArgumentNullException;
    use \System\ArgumentException as ArgumentException;
    use \System\ObjectDisposedException as ObjectDisposedException;

    use \System\IO\FileMode as FileMode;
    use \System\IO\TextReader as TextReader;

    /**
     * TODO: Implement currentEncoding()
     */


    /**
     * Implements a System.IO.TextReader that reads characters from a byte stream in a particular encoding.
     * @access public
     * @name StreamReader
     * @package System
     * @subpackage IO
     */
    class StreamReader extends TextReader {

        /**
         * Initializes a new instance of the System.IO.StreamReader class for the specified file name.
         * @throws ArgumentException|ArgumentNullException|FileNotFoundException|DirectoryNotFoundException|IOException
         * @param string $path The complete file path to be read.
         */
        public function __construct($path) {
            if(is_null($path)) throw new ArgumentNullException("path is null.");
            if(strlen($path) == 0) throw new ArgumentException('path is an empty string ("")');
            if(!file_exists($path)) throw new IOException("The file cannot be found.");
            $this->resource = fopen($path, FileMode::openOrCreate()->value());
        }

        /**
         * Gets the current character encoding that the current System.IO.StreamReader object is using.
         * @access public
         * @return Encoding The current character encoding used by the current reader. The value can be different after the first call to any Overload:System.IO.StreamReader.Read method of System.IO.StreamReader, since encoding autodetection is not done until the first call to a Overload:System.IO.StreamReader.Read method.
         */
        public function currentEncoding() {}

        /**
         * Gets a value that indicates whether the current stream position is at the end of the stream.
         * @access public
         * @throws ObjectDisposedException
         * @return bool true if the current stream position is at the end of the stream; otherwise false.
         */
        public function endOfStream() {
            if(!isset($this->resource)) throw new ObjectDisposedException("The underlying stream has been disposed.");
            return feof($this->resource);
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
            try {
                $position = ftell($this->resource);
                $value = $this->read();
                fseek($this->resource, $position);
                return $value;
            } catch(\Exception $e) {
                throw new IOException("An I/O error occurs.");
            }
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
            if(is_null($index))
                return $this->readOnlyCharacter();
            return $this->readBlock($index, $count);
        }

        /**
         * Reads a maximum of count characters from the current stream, and writes the data to buffer, beginning at index.
         * @access public
         * @throws ArgumentNullException|ArgumentException|ArgumentOutOfRangeException|ObjectDisposedException|IOException
         * @param array $buffer When this method returns, contains the specified character array with the values between index and (index + count - 1) replaced by the characters read from the current source.
         * @param int $index The place in buffer at which to begin writing.
         * @param int $count The maximum number of characters to read. If the end of the stream is reached before count of characters is read into buffer, the current method returns.
         * @return int The position of the underlying stream is advanced by the number of characters that were read into buffer.
         */
        public function readBlock($index=0, $count=0) {
            $buffer = array();
            $copy_area_size = $index + $count;
            
            if(!isset($this->resource)):
                throw new IOException("An I/O error occurs, such as the stream is closed.");
            endif;
            
            for($i = $index; $i < $copy_area_size; $i++):
                array_push($buffer, fgetc($this->resource));
            endfor;
            
            return array(
                'buffer' => $buffer,
                'count' => $count
            );
        }

        /**
         * Reads a line of characters from the current stream and returns the data as a string.
         * @access public
         * @throws IOException|OutOfMemoryException|ObjectDisposedException|ArgumentOutOfRangeException
         * @return string The next line from the input stream, or null if all characters have been read.
         */
        public function readLine() {
            if(!isset($this->resource)) throw new IOException("An I/O error occurs.");
            return stream_get_line($this->resource, 4096, "\r\n");
        }

        /**
         * Reads all characters from the current position to the end of the TextReader and returns them as one string.
         * @access public
         * @throws IOException|ObjectDisposedException|OutOfMemoryException|ArgumentOutOfRangeException
         * @return string A string containing all characters from the current position to the end of the TextReader.
         */
        public function readToEnd() {
            if(!isset($this->resource)) throw new IOException("An I/O error occurs.");
            return stream_get_contents($this->resource, -1);
        }

        /**
         * Read next character
         * @access protected
         * @return string
         */
        protected function readOnlyCharacter() {
            return array(
                'buffer' => fgetc($this->resource),
                'count'  => 1
            );
        }
    }
}
