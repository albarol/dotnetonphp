<?php

namespace System\IO {

    use \System\ArgumentException as ArgumentException;
    use \System\ArgumentNullException as ArgumentNullException;
    use \System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;
    use \System\NotSupportedException as NotSupportedException;
    use \System\ObjectDisposedException as ObjectDisposedException;

    /**
     * Exposes a Stream around a file, supporting both synchronous and asynchronous read and write operations.
     *
     * @access public
     * @name FileStream
     * @package System
     * @subpackage IO
     */
    class FileStream extends Stream {

        private $stream;
        private $access;
        private $mode;
        private $fileName;

        /**
         * Initializes a new instance of the FileStream class with the specified path, creation mode, and read/write permission.
         *
         * @access public
         * @throws \System\ArgumentNullException path is null.
         * @throws \System\ArgumentException path is an empty string (""), contains only white space, or contains one or more invalid characters.
         * @throws \System\IO\FileNotFoundException The file cannot be found, such as when mode is FileMode.Truncate or FileMode.Open, and the file specified by path does not exist.The file must already exist in these modes.
         * @throws \System\IO\PathTooLongException The specified path, file name, or both exceed the system-defined maximum length.
         * @throws \System\IO\IOException An I/O error occurs, such as specifying FileMode.CreateNew and the file specified by path already exists. -or- The stream has been closed.
         * @throws \System\Security\SecurityException The caller does not have the required permission.
         * @param string $path A relative or absolute path for the file that the current FileStream object will encapsulate.
         * @param string $mode A constant that determines how to open or create the file.
         * @param int $access A constant that determines how the file can be accessed by the FileStream object. This gets the CanRead and CanWrite properties of the FileStream object.
         */
        public function __construct($path, $mode=null, $access=null) {

            if(is_null($path)) {
                throw new ArgumentNullException("path is null.");
            }

            if(strlen($path) == 0) {
                throw new ArgumentException('path is an empty string (""), contains only white space, or contains one or more invalid characters.');
            }

            if (strlen($path) > 258) { // Max PATH size
                throw new PathTooLongException("The specified path, file name, or both exceed the system-defined maximum length.");
            }

            if(is_null($mode)) {
                $mode = FileMode::open();
            }

            if(is_null($access)) {
                $access = FileAccess::read();
            }

            if($mode == FileMode::open() && !file_exists($path))
            {
                throw new FileNotFoundException("The file cannot be found, such as when mode is FileMode.Truncate or FileMode.Open, and the file specified by path does not exist.");
            }

            $this->openFile($path, $mode, $access);
        }

        private function openFile($path, $mode, $access) {
            if(($mode == FileMode::openOrCreate()) && !file_exists($path)) {
                $mode = FileMode::truncate();
            }

            $this->stream = fopen($path, $mode->value()."b");
            $this->mode = $mode;
            $this->access = $access;
            $this->fileName = $path;
        }

        /**
         * Performs application-defined tasks associated with freeing, releasing, or resetting unmanaged resources.
         *
         * @access public
         */
        public function dispose() {
            unset($this->stream);
        }

        /**
         * Gets a value that determines whether the current stream can supports reading.
         *
         * @access public
         * @return bool true if the stream supports reading; otherwise, false.
         */
        public function canRead() {
            return ($this->access != FileAccess::write()) && isset($this->stream);
        }

        /**
         * Gets a value that determines whether the current stream can supports seeking.
         *
         * @access public
         * @return bool true if the stream supports seeking; otherwise, false.
         */
        public function canSeek() {
            return isset($this->stream);
        }

        /**
         * Gets a value that determines whether the current stream can time out.
         *
         * @access public
         * @return bool A value that determines whether the current stream can time out.
         */
        public function canTimeout() {
            return false;
        }

        /**
         * Gets a value that determines whether the current stream can supports writing.
         *
         * @access public
         * @return bool true if the stream supports writing; otherwise, false.
         */
        public function canWrite() {
            return ($this->access != FileAccess::read()) &&
                   ($this->mode != FileMode::open()) &&
                   isset($this->stream);
        }

        /**
         * Clears all buffers for this stream and causes any buffered data to be written to the file system.
         *
         * @access public
         * @throws \System\IOException An I/O error occurs.
         * @throws \System\ObjectDisposedException The stream is closed.
         * @return void
         */
        public function flush() {
            $this->assertOpened();
            try{
                fflush($this->stream);
            } catch(Exception $e) {
                throw new IOException("An I/O error occurs.");
            }
        }

        /**
         * Gets a FileSecurity object that encapsulates the access control list (ACL) entries for the file described by the current FileStream object.
         *
         * @access public
         * @throws \System\ObjectDisposedException The file is closed.
         * @throws \System\IO\IOException An I/O error occurred while opening the file.
         * @throws \System\SystemException The file could not be found.
         * @throws \System\UnauthorizedAccessException This operation is not supported on the current platform.
         * @return \System\Security\AccessControl\FileSecurity A FileSecurity object that encapsulates the access control settings for the file described by the current FileStream object.
        */
        public function getAccessControl() { }

        /**
         * Gets a value indicating whether the FileStream was opened asynchronously or synchronously.
         *
         * @access public
         * @return bool  true if the FileStream was opened asynchronously; otherwise, false.
        */
        public function isAsync() {
            return false;
        }

        /**
         * Gets the length in bytes of the stream
         *
         * @access public
         * @return float A long value representing the length of the stream in bytes.
         */
        public function length() {
            return filesize($this->fileName);
        }

        /**
         * Gets the name of the FileStream that was passed to the constructor.
         * @access public
         * @return string A string that is the name of the FileStream.
         */
        public function name() {
            return $this->fileName;
        }

        /**
         * Gets or sets the current position of this stream.
         *
         * @access public
         * @throws \System\NotSupportedException The stream does not support seeking.
         * @throws \System\IO\IOException An I/O error occurs.
         * @throws \System\ArgumentOutOfRangeException Attempted to set the position to a negative value.
         * @param int $value Set the position
         * @return The current position within the stream.
         */
        public function position($value=null) {
            $this->assertOpened();

            if(!is_null($value)) {

                if($value < 0) {
                    throw new ArgumentOutOfRangeException("Attempted to set the position to a negative value.");
                }

                if(!$this->canSeek()) {
                    throw new NotSupportedException("The stream does not support seeking.");
                }

                try{
                    fseek($this->stream, $value);
                } catch(Exception $e) {
                    throw new IOException("An I/O error occurred.");
                }
            }
            try {
                return ftell($this->stream);
            } catch(\Exception $e) {
                throw new IOException("An I/O error occurred.");
            }
        }

        /**
         * Prevents other processes from changing the FileStream.
         *
         * @access public
         * @throws \System\ObjectDisposedException The file is closed.
         * @throws \System\IO\IOException The process cannot access the file because another process has locked a portion of the file.
         * @return void
         */
        public function lock() {
            $this->assertOpened();
            try {
                flock($this->stream, LOCK_EX);
            } catch(Exception $e) {
                throw new IOException("The process cannot access the file because another process has locked a portion of the file.");
            }
        }

        /**
         * Reads a block of bytes from the stream and writes the data in a given buffer.
         *
         * @access public
         * @throws \System\ArgumentOutOfRangeException offset or count is negative.
         * @throws \System\IO\IOException An I/O error occurred.
         * @throws \System\NotSupportedException The stream does not support reading.
         * @throws \System\ObjectDisposedException Methods were called after the stream was closed.
         * @param int $offset The zero-based byte offset in buffer at which to begin storing the data read from the current stream.
         * @param int $count The maximum number of bytes to be read from the current stream.
         * @return array Block of bytes from the stream
         */
        public function read($offset=0, $count=null) {

            $this->assertOpened();
            $this->assertRead();

            if ($offset < 0 || $count < 0) {
                throw new ArgumentOutOfRangeException("offset or count is negative.");
            }

            try {
                if (!is_null($count)) {
                    fseek($this->stream, $offset);
                    $content = fread($this->stream, $count);
                }
                else {
                    $content = stream_get_contents($this->stream, -1, $offset);
                }

                return str_split($content);
            } catch(\Exception $e) {
                throw new IOException("An I/O error occurred.");
            }
        }

        /**
         * Reads a byte from the stream and advances the position within the stream by one byte, or returns -1 if at the end of the stream.
         *
         * @access public
         * @throws \System\NotSupportedException The current stream does not support reading.
         * @throws \System\ObjectDisposeException The current stream is closed.
         * @return int The unsigned byte cast to an Int32, or -1 if at the end of the stream.
         */
        public function readByte() {
            $this->assertOpened();
            $this->assertRead();

            if(feof($this->stream)) {
                return -1;
            }

            return fgetc($this->stream);
        }

        /**
         * Sets the current position of this stream to the given value.
         *
         * @access public
         * @throws \System\IOException An I/O error occurs.
         * @throws \System\NotSupportedException The stream does not support seeking, such as if the FileStream is constructed from a pipe or console output.
         * @throws \SystemObjectDisposedException Methods were called after the stream was closed.
         * @param int $offset A byte offset relative to the origin parameter.
         * @param int $origin A value of type SeekOrigin indicating the reference point used to obtain the new position.
         * @return float The new position within the current stream.
         */
        public function seek($offset, $origin=null) {
            $this->assertOpened();

            if (is_null($origin)) {
                $origin = SeekOrigin::begin();
            }

            if($origin == SeekOrigin::end()) {
                $offset = $offset*-1;
            }

            try {
                fseek($this->stream, $offset, $origin->value());
            }
            catch (\Exception $e) {
                throw new IOException("An I/O error ocurs.");
            }
        }

        /**
         * Applies access control list (ACL) entries described by a FileSecurity object to the file described by the current FileStream object.
         *
         * @access public
         * @throws \System\ObjectDisposedException The file is closed.
         * @throws \System\ArgumentNullException The fileSecurity parameter is null.
         * @throws \System\SystemException The file could not be found.
         * @throws \System\UnauthorizedAccessException This operation is not supported on the current platform. -or- The caller does not have the required permission.
         * @param \System\Security\AccessControl\FileSecurity $fileSecurity A FileSecurity object that describes an ACL entry to apply to the current file.
         * @return void
        */
        public function setAccessControl($fileSecurity){}

        /**
         * Sets the length of this stream to the given value.
         *
         * @access public
         * @throws \System\IOException An I/O error has occurred.
         * @throws \System\NotSupportedException The stream does not support both writing and seeking.
         * @throws \System\ArgumentOutOfRangeException Attempted to set the value parameter to less than 0.
         * @param int $value The desired length of the current stream in bytes.
         * @return void
         */
        public function setLength($value) {

            if(!$this->canWrite() || !$this->canSeek()) {
                throw new NotSupportedException("The stream does not support both writing and seeking.");
            }

            if($value < 0) {
                throw new ArgumentOutOfRangeException("Attempted to set the value parameter to less than 0.");
            }

            try {
                ftruncate($this->stream, $value);
            } catch(\Exception $e) {
                throw new IOException("An I/O error has occurred.");
            }
        }


        /**
         * Allows access by other processes to all or part of a file that was previously locked.
         *
         * @access public
         * @return void
         */
        public function unlock() {
            flock($this->stream, LOCK_UN);
        }


        /**
         * Writes a block of bytes to this stream using data from a buffer.
         *
         * @access public
         * @throws \System\ArgumentNullException buffer is null.
         * @throws \System\ArgumentException offset and count describe an invalid range in array.
         * @throws \System\ArgumentOutOfRangeException offset or count is negative.
         * @throws \System\IO\IOException An I/O error ocurrs.
         * @throws \System\ObjectDisposedException The stream is closed.
         * @throws \System\NotSupportedException The current stream instance does not support writing.
         * @param array $buffer An array of bytes. This method copies count bytes from buffer to the current stream.
         * @param int $offset The zero-based byte offset in buffer at which to begin copying bytes to the current stream.
         * @param int $count The number of bytes to be written to the current stream.
         * @return void
         */
        public function write($buffer, $offset=0, $count=null) {

            $this->assertOpened();
            $this->assertWrite();

            if (is_string($buffer)) {
                $buffer = str_split($buffer);
            }

            $count = is_null($count) ? sizeof($buffer) - $offset : $count;
            $area = $offset + $count;

            if(is_null($buffer)) {
                throw new ArgumentNullException("buffer is null.");
            }

            if($offset < 0 || $count < 0) {
                throw new ArgumentOutOfRangeException("offset or count is negative.");
            }

            if($area > sizeof($buffer)) {
                throw new ArgumentException("offset and count describe an invalid range in array.");
            }

            try {
                fwrite($this->stream, implode(array_slice($buffer, $offset, $count)));
            }
            catch (\Exception $e) {
                throw new IOException("An I/O error occours.");
            }

        }

        /**
         * Writes a byte to the current position in the stream and advances the position within the stream by one byte.
         *
         * @access public
         * @throws \System\IO\IOException An I/O error ocurrs.
         * @throws \System\ObjectDisposedException The stream is closed.
         * @throws \System\NotSupportedException The current stream instance does not support writing.
         * @param $value The byte to write to the stream.
         * @return void
         */
        public function writeByte($value) {
            $this->assertOpened();
            $this->assertWrite();

            try {
                fwrite($this->stream, $value);
            }
            catch (\Exception $e) {
                throw new IOException("An I/O error occours.");
            }
        }

        /***********************
            ASSERT METHODS
        ***********************/
        private function assertOpened() {
            if(!isset($this->stream)) {
                throw new ObjectDisposedException("The stream is closed.");
            }
        }

        private function assertRead() {
            if (!$this->canRead()) {
                throw new NotSupportedException("The stream does not support reading.");
            }
        }

        private function assertWrite() {
            if (!$this->canWrite()) {
                throw new NotSupportedException("The current stream instance does not supporte writing.");
            }
        }
    }
}
