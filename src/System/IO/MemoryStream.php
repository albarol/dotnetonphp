<?php

namespace System\IO {


    use \System\ArgumentNullException as ArgumentNullException;
    use \System\ArgumentOutOfRangeException as ArgumentOutOfRangeException;
    use \System\ObjectDisposedException as ObjectDisposedException;
    use \System\ArgumentException as ArgumentException;
    use \System\NotSupportedException as NotSupportedException;
    use \System\IO\Stream as Stream;

    /**
     * Creates a stream whose backing store is memory.
     * @access public
     * @name MemoryStream
     * @package System
     * @subpackage IO
     */
    class MemoryStream extends Stream {

        private $memory = array();
        private $writable = true;
        private $capacity = 0;
        private $position = 0;

        /**
         * Initializes a new non-resizable instance of the System.IO.MemoryStream class based on the specified
         * region of a byte array, with the System.IO.MemoryStream.CanWrite property set as specified.
         * @access public
         * @throws \System\ArgumentException The sum of index and count is greater than the length of buffer.
         * @throws \System\ArgumentNullException buffer is null.
         * @throws \System\ArgumentOutOfRangeException index or count are negative.
         * @param array $buffer The array of unsigned bytes from which to create this stream.
         * @param int $index The index in buffer at which the stream begins.
         * @param int $count The length of the stream in bytes.
         * @param bool $writable The setting of the System.IO.MemoryStream.CanWrite property, which determines whether the stream supports writing.
         */
        public function __construct($buffer=array(), $index=null, $count=null, $writable=true) 
        {
            if(is_null($buffer)) 
            {
                throw new ArgumentNullException("buffer is null.");
            }

            if($index < 0 || $count < 0) 
            {
                throw new ArgumentOutOfRangeException("index or count are negative.");
            }
            $this->createMemory($buffer, $index, $count);
            $this->writable = $writable;
        }

        private function createMemory($buffer, $index, $count) 
        {
            if(is_null($index)) 
            {
                $this->memory = $buffer;
            } 
            else 
            {
                $finalIndex = $index + $count;
                
                if($finalIndex > sizeof($buffer)) 
                {
                    throw new ArgumentException("The sum of index and count is greater than the length of buffer.");
                }

                for($i = $index; $i < $finalIndex; $i++)
                {
                    array_push($this->memory, $buffer[$i]);
                }
            }
            
            $this->capacity = isset($this->memory) ? sizeof($this->memory) : 0;
        }

        /**
         * Performs application-defined tasks associated with freeing, releasing, or resetting unmanaged resources.
         * @access public
         * @return void
         */
        public function dispose() {
            unset($this->memory);
        }

        /**
         * When overridden in a derived class, gets a value indicating whether the current stream supports reading.
         * @access public
         * @return bool true if the stream supports reading; otherwise, false.
         */
        public function canRead() {
            return isset($this->memory);
        }

        /**
         * When overridden in a derived class, gets a value indicating whether the current stream supports seeking.
         * @access public
         * @return bool true if the stream supports seeking; otherwise, false.
         */
        public function canSeek() {
            return isset($this->memory);
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
            return $this->writable && isset($this->memory);
        }


        /**
         * Gets or sets the number of bytes allocated for this stream.
         * @access public
         * @param int $value number of bytes
         * @return int The length of the usable portion of the buffer for the stream.
         */
        public function capacity($value=null) {
            if(!is_null($value)) {
                $this->capacity = $value;
            }
            return $this->capacity;
        }

        /**
         * When overridden in a derived class, clears all buffers for this stream and causes any buffered data to be written to the underlying device.
         * @access public
         * @throws IOException
         * @return void
         */
        public function flush() {
            $this->capacity(sizeof($this->memory));
        }

        /**
         * When overridden in a derived class, gets the length in bytes of the stream.
         * @access public
         * @return float A long value representing the length of the stream in bytes.
         */
        public function length() {
            return sizeof($this->memory);
        }

        /**
         * When overridden in a derived class, gets or sets the position within the current stream.
         * @access public
         * @param int $value Set the position
         * @return The current position within the stream.
         */
        public function position($value = null) {
           if(!$this->canSeek()) throw new ObjectDisposedException("The stream does not support seeking.");
            if(!is_null($value)) {
                if($value < 0) throw new ArgumentOutOfRangeException("Attempted to set the position to a negative value.");
                $this->position = $value;
           }
           return $this->position;
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

            if(!$this->canRead()) throw new ObjectDisposedException("The current stream instance is closed.");
            if(is_null($buffer)) throw new ArgumentNullException("buffer is null.");
            if($offset < 0 || $count < 0) throw new ArgumentException("offset or count is negative.");

            while(($offset < $copyAreaSize) && $this->position() < sizeof($this->memory)) {
                array_push($buffer, $this->readByte());
                $offset++;
            }
            return $copyAreaSize - $offset;
        }

        /**
         * Reads a byte from the stream and advances the position within the stream by one byte, or returns -1 if at the end of the stream.
         * @access public
         * @return int The unsigned byte cast to an Int32, or -1 if at the end of the stream.
         */
        public function readByte() {
            if(!$this->canRead()) throw new ObjectDisposedException("The current stream instance is closed.");
            return $this->memory[$this->position++];
        }

        /**
         * When overridden in a derived class, sets the position within the current stream.
         * @access public
         * @throws IOException|NotSupportedException|ObjectDisposedException
         * @param float $offset A byte offset relative to the origin parameter.
         * @param int $origin A value of type SeekOrigin indicating the reference point used to obtain the new position.
         * @return float The new position within the current stream.
         */
        public function seek($offset, $origin=SeekOrigin::Current) {
            if(!$this->canSeek()) throw new ObjectDisposedException("Methods were called after the stream was closed.");
            if($origin == SeekOrigin::Begin)
                $this->position($offset);
            else if($origin == SeekOrigin::Current)
                $this->position($offset + $this->position());
            else
                $this->position($this->length() - $offset);
        }

        /**
         * When overridden in a derived class, sets the length of the current stream.
         * @access public
         * @throws IOException|NotSupportedException|ObjectDisposedException
         * @param int $value The desired length of the current stream in bytes.
         * @return void
         */
        public function setLength($value) {
            if($value < 0) throw new ArgumentOutOfRangeException("The current stream is not resizable and value is larger than the current capacity. -or- The current stream does not support writing.");
            if(!$this->canWrite() || $value > $this->length()) throw new NotSupportedException("value is negative or is greater than the maximum length of the MemoryStream, where the maximum length is(MaxValue - origin), and origin is the index into the underlying buffer at which the stream starts.");
            $current = $this->memory;
            for($i = $value; $i < $this->length(); $i++)
                unset($current[$i]);
            $this->memory = array_values($current);
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
            while(!$this->position() < sizeof($this->memory))
                array_push($buffer, $this->readByte());
            $this->position($position);
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
            $copyAreaSize = $offset + $count;

            if(is_null($array)) throw new ArgumentNullException("array is null.");
            if($offset < 0 || $count < 0) throw new ArgumentOutOfRangeException("offset or count is negative.");
            if(($copyAreaSize) > sizeof($array)) throw new ArgumentException("offset and count describe an invalid range in array.");

            while(($offset < $copyAreaSize) && $this->position() <= $this->length()) {
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
            if(!isset($this->memory)) throw new ObjectDisposedException("The current stream is closed.");
            if(!$this->canWrite()) throw new NotSupportedException("The stream does not support writing. For additional information see CanWrite.");
            $this->memory[$this->position++] = $value;
        }


    }
}
