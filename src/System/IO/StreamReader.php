<?php

namespace System\IO
{
    use \System\ArgumentNullException as ArgumentNullException;
    use \System\ArgumentException as ArgumentException;
    use \System\ObjectDisposedException as ObjectDisposedException;

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
    class StreamReader extends TextReader
    {
        /**
         * Initializes a new instance of the System.IO.StreamReader class for the specified file name.
         *
         * @throws \System\ArgumentException path is an empty string.
         * @throws \System\ArgumentNullException path is null.
         * @throws \System\IO\FileNotFoundException The file cannot be found.
         * @throws \System\NotSupportedException Resource not supported.
         * @param object $resource The complete file path to be read. -or- Stream that from memory or file.
         */
        public function __construct($resource)
        {

            if (is_null($resource)) {
                throw new ArgumentNullException("path is null.");
            }

            if (is_string($resource)) {
                $this->stream = new FileStream($resource);
            }

            if ($resource instanceof Stream) {
                $this->stream = $resource;
            }

            if (is_null($this->stream)) {
                throw new NotSupportedException("Resource not supported.");
            }
        }

        /**
         * Gets the current character encoding that the current System.IO.StreamReader object is using.
         *
         * @access public
         * @return \System\Text\Encoding The current character encoding used by the current reader. The value can be different after the first call to any Overload:System.IO.StreamReader.Read method of System.IO.StreamReader, since encoding autodetection is not done until the first call to a Overload:System.IO.StreamReader.Read method.
         */
        public function currentEncoding() {}

        /**
         * Gets a value that indicates whether the current stream position is at the end of the stream.
         *
         * @access public
         * @throws \System\ObjectDisposedException The underlying stream has been disposed.
         * @return bool true if the current stream position is at the end of the stream; otherwise false.
         */
        public function endOfStream() {
            if(!isset($this->stream)) {
                throw new ObjectDisposedException("The underlying stream has been disposed.");
            }
            return $this->stream->position() == $this->stream->length();
        }

        /**
         * Performs application-defined tasks associated with freeing, releasing, or resetting unmanaged resources.
         * @access public
         * @return void
         */
        function dispose()
        {
            $this->close();
        }

        /**
         * Reads the next character without changing the state of the reader or the character source. Returns the next available character without actually reading it from the input stream.
         *
         * @access public
         * @throws \System\IO\IOException An I/O error occurs.
         * @return string returns the next available character but does not consume it.
         */
        public function peek() {
            try {
                $position = $this->stream->position();
                $value = $this->readBlock($position, 1);
                $this->stream->seek($position);
                return implode($value);
            }
            catch (\Exception $e) {
                throw new IOException("An I/O error occurs.");
            }
        }

        /**
         * Reads the next character from the input stream and advances the character position by one character.
         *
         * @access public
         * @throws \System\IO\IOException An I/O error occurs.
         * @return string The next character from the input stream.
         */
        public function read() {
            try {
                return implode($this->readBlock($this->stream->position(), 1));
            }
            catch (\Exception $e) {
                throw new IOException("An I/O error occurs.");
            }
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
        public function readBlock($index=0, $count=null) {
            return $this->stream->read($index, $count);
        }

        /**
         * Reads a line of characters from the current stream and returns the data as a string.
         * @access public
         * @throws IOException|OutOfMemoryException|ObjectDisposedException|ArgumentOutOfRangeException
         * @return string The next line from the input stream, or null if all characters have been read.
         */
        public function readLine() {
            // if(!isset($this->resource)) throw new IOException("An I/O error occurs.");
            // return stream_get_line($this->resource, 4096, "\r\n");
        }

        /**
         * Reads all characters from the current position to the end of the TextReader and returns them as one string.
         *
         * @access public
         * @throws \System\IO\IOException An I/O error occurs.
         * @throws \System\OutOfMemoryException There is insufficient memory to allocate a buffer for the returned string.
         * @return string A string containing all characters from the current position to the end of the TextReader.
         */
        public function readToEnd() {
            return $this->stream->read($this->stream->position());
        }

        /**
         * Read next character
         * @access protected
         * @return string
         */
        protected function readOnlyCharacter() {
            return array(
                'buffer' => fgetc($this->stream),
                'count'  => 1
            );
        }
    }
}
