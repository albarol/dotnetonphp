<?php

namespace System\IO {

    use \System\ArgumentException as ArgumentException;
    use \System\ArgumentNullException as ArgumentNullException;
    use \System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;
    use \System\NotSupportedException as NotSupportedException;
    use \System\ObjectDisposedException as ObjectDisposedException;
    
    use \System\IO\FileAccess as FileAccess;
    use \System\IO\FileNotFoundException as FileNotFoundException;
    use \System\IO\FileMode as FileMode;
    use \System\IO\IOException as IOException;
    use \System\IO\SeekOrigin as SeekOrigin;
    use \System\IO\Stream as Stream;
    

    /**
     * Exposes a Stream around a file, supporting both synchronous and asynchronous read and write operations.
     * @access public
     * @package System
     * @subpackage IO
     * @name FileStream
     */
    class FileStream extends Stream {

        private $stream;
        private $access;
        private $mode;
        private $fileName;


        /**
         * Initializes a new instance of the FileStream class with the specified path, creation mode, and read/write permission.
         * @access public
         * @throws ArgumentNullException|ArgumentException|FileNotFoundException|IOException|SecurityException
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
            
            if(is_null($mode)) {
                $mode = FileMode::open();
            }

            if(is_null($access)) {
                $access = FileAccess::read();
            }

            if($mode == FileMode::open() && !file_exists($path)) {
                throw new FileNotFoundException("The file cannot be found, such as when mode is FileMode.Truncate or FileMode.Open, and the file specified by path does not exist.");
            }

            $this->openFile($path, $mode, $access);
        }

        private function openFile($path, $mode, $access) {
            if(($mode == FileMode::openOrCreate()) && !file_exists($path))
                $mode = FileMode::truncate();
            $this->stream = fopen($path, $mode->value());
            $this->mode = $mode;
            $this->access = $access;
            $this->fileName = $path;
        }

        /**
         * Performs application-defined tasks associated with freeing, releasing, or resetting unmanaged resources.
         * @access public
         */
        function dispose() {
            unset($this->stream);
        }

        /**
         * When overridden in a derived class, gets a value indicating whether the current stream supports reading.
         * @access public
         * @return bool true if the stream supports reading; otherwise, false.
         */
        public function canRead() {
            return ($this->access != FileAccess::write()) && isset($this->stream);
        }

        /**
         * When overridden in a derived class, gets a value indicating whether the current stream supports seeking.
         * @access public
         * @return bool true if the stream supports seeking; otherwise, false.
         */
        public function canSeek() {
            return isset($this->stream);
        }

        /**
         * Gets a value that determines whether the current stream can time out.
         * @access public
         * @return bool A value that determines whether the current stream can time out.
         */
        public function canTimeout() {
            return false;
        }

        /**
         * When overridden in a derived class, gets a value indicating whether the current stream supports writing.
         * @access public
         * @return bool true if the stream supports writing; otherwise, false.
         */
        public function canWrite() {
            return ($this->access != FileAccess::Read) &&
                   ($this->mode != FileMode::Open) &&
                   isset($this->stream);
        }

        /**
         * When overridden in a derived class, clears all buffers for this stream and causes any buffered data to be written to the underlying device.
         * @access public
         * @throws IOException
         * @return void
         */
        public function flush() {
            try{
                fflush($this->stream);
            } catch(Exception $e) {
                throw new IOException("An I/O error occurs.");
            }
        }

        /**
         * When overridden in a derived class, gets the length in bytes of the stream.
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
         * When overridden in a derived class, gets or sets the position within the current stream.
         * @access public
         * @param int $value Set the position
         * @return The current position within the stream.
         */
        public function position($value=null) {
            if(!is_null($value)) {
                if($value < 0) throw new ArgumentOutOfRangeException("Attempted to set the position to a negative value.");
                if(!$this->canSeek()) throw new NotSupportedException("The stream does not support seeking.");
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
         * @access public
         * @return void
         */
        public function lock() {
            if(!isset($this->stream)) throw new ObjectDisposedException("The file is closed.");
            try {
                flock($this->stream, LOCK_EX);
            } catch(Exception $e) {
                throw new IOException("The process cannot access the file because another process has locked a portion of the file.");
            }
        }

        /**
         * When overridden in a derived class, reads a sequence of bytes from the current stream and advances the position within the stream by the number of bytes read.
         * @access public
         * @throws ArgumentException|ArgumentNullException|ArgumentOutOfRangeException|IOException|NotSupportedException|ObjectDisposedException
         * @param array $buffer An array of bytes. When this method returns, the buffer contains the specified byte array with the values between offset and (offset + count - 1) replaced by the bytes read from the current source.
         * @param int $offset The zero-based byte offset in buffer at which to begin storing the data read from the current stream.
         * @param int $count The maximum number of bytes to be read from the current stream.
         * @return int The total number of bytes read into the buffer. This can be less than the number of bytes requested if that many bytes are not currently available, or zero (0) if the end of the stream has been reached.
         */
        public function read(&$buffer, $offset, $count) {
            $copyAreaSize = $offset + $count;
            if(is_null($buffer)) throw new ArgumentNullException("buffer is null.");
            if($offset < 0 || $count < 0) throw new ArgumentException("offset or count is negative.");

            try {
                while(($offset < $copyAreaSize) && !feof($this->stream)) {
                    array_push($buffer, $this->readByte());
                    $offset++;
                }
                return $copyAreaSize - $offset;
            } catch(\Exception $e) {
                throw new IOException("An I/O error occurred.");
            }
        }

        /**
         * Reads a byte from the stream and advances the position within the stream by one byte, or returns -1 if at the end of the stream.
         * @access public
         * @return int The unsigned byte cast to an Int32, or -1 if at the end of the stream.
         */
        public function readByte() {
            if(!isset($this->stream)) throw new ObjectDisposedException("The current stream is closed.");
            if(!$this->canRead()) throw new NotSupportedException("The current stream does not support reading.");
            if(feof($this->stream))
                return -1;
            return fgetc($this->stream);
        }

        /**
         * When overridden in a derived class, sets the position within the current stream.
         * @access public
         * @throws IOException|NotSupportedException|ObjectDisposedException
         * @param int $offset A byte offset relative to the origin parameter.
         * @param int $origin A value of type SeekOrigin indicating the reference point used to obtain the new position.
         * @return float The new position within the current stream.
         */
        public function seek($offset, $origin=SeekOrigin::Begin) {
            if(!isset($this->stream)) throw new ObjectDisposedException("Methods were called after the stream was closed.");
            if($origin == SeekOrigin::End)
                $offset = $offset*-1;
            fseek($this->stream, $offset, $origin);
        }

        /**
         * When overridden in a derived class, sets the length of the current stream.
         * @access public
         * @throws IOException|NotSupportedException|ObjectDisposedException
         * @param int $value The desired length of the current stream in bytes.
         * @return void
         */
        public function setLength($value) {
            if(!$this->canWrite() || !$this->canSeek()) throw new NotSupportedException("The stream does not support both writing and seeking.");
            if($value < 0) throw new ArgumentOutOfRangeException("Attempted to set the value parameter to less than 0.");
            try {
                ftruncate($this->stream, $value);
            } catch(Exception $e) {
                throw new IOException("An I/O error has occurred.");
            }
        }


        /**
         * Allows access by other processes to all or part of a file that was previously locked.
         * @access public
         * @return void
         */
        public function unlock() {
            flock($this->stream, LOCK_UN);
        }


        /**
         * When overridden in a derived class, writes a sequence of bytes to the current stream and advances the current position within this stream by the number of bytes written.
         * @access public
         * @param array $array An array of bytes. This method copies count bytes from buffer to the current stream.
         * @param int $offset The zero-based byte offset in buffer at which to begin copying bytes to the current stream.
         * @param int $count The number of bytes to be written to the current stream.
         * @return void
         */
        public function write($array, $offset, $count) {
            $copyAreaSize = $offset+$count;

            if(is_null($array)) throw new ArgumentNullException("array is null.");
            if($offset < 0 || $count < 0) throw new ArgumentOutOfRangeException("offset or count is negative.");
            if(($copyAreaSize) > sizeof($array)) throw new ArgumentException("offset and count describe an invalid range in array.");

            while(($offset < $copyAreaSize) && !feof($this->stream)) {
                $this->writeByte($array[$offset]);
                $offset++;
            }
        }

        /**
         * Writes a byte to the current position in the stream and advances the position within the stream by one byte.
         * @access public
         * @throws IOException|NotSupportedException|ObjectDisposedException
         * @param $value The byte to write to the stream.
         * @return void
         */
        public function writeByte($value) {
            if(!isset($this->stream)) throw new ObjectDisposedException("The stream is closed.");
            if(!$this->canWrite()) throw new NotSupportedException("The stream does not support writing.");
            fwrite($this->stream, $value);
        }

        /**
         * Writes the stream contents to a byte array, regardless of the Position property.
         * @access public
         * @return array A new byte array.
         */
        public function toArray() {
            if(!$this->canRead()) return array();
            $buffer = array();
            $position = $this->position();
            while(!feof($this->stream))
                array_push($buffer, $this->readByte());
            $this->position($position);
            return $buffer;
        }
    }
}