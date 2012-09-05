<?php

namespace System\IO;

require_once("TextWriter.php");
require_once("IOException.php");
require_once("FileMode.php");
require_once("FileStream.php");

use \System\ObjectDisposedException as ObjectDisposedException;


/**
 * Implements a TextWriter for writing characters to a stream in a particular encoding.
 * @access public
 * @package System
 * @subpackage IO
 * @name StreamWriter
 */
class StreamWriter extends TextWriter {

    private $autoFlush;
    private $fileName;

    public function __construct($path, $append=false) {
        if(is_null($path) || strlen($path) == 0) throw new IOException("File was not opened.");
        $this->fileName = $path;
        $this->openFile($append);
    }

    private function openFile($append) {
        if($append)
            $this->resource = fopen($this->fileName, FileMode::Append);
        if (file_exists($this->fileName))
            $this->resource = fopen($this->fileName, FileMode::OpenOrCreate);
        else
            $this->resource = fopen($this->fileName, FileMode::Create);
    }

    /**
     * Closes the current StreamWriter object and the underlying stream.
     * @throws EncoderFallbackException
     * @return void
     */
    public function close() {
        fclose($this->resource);
    }


    /**
     * Gets or sets a value indicating whether the System.IO.StreamWriter will flush its buffer to the underlying stream after every call to System.IO.StreamWriter.Write(System.Char).
     * @access public
     * @param bool $autoFlush
     * @return void
     */
    public function autoFlush($autoFlush=null) {
        if(is_bool($autoFlush))
            $this->autoFlush = $autoFlush;
        return $this->autoFlush;
    }


    /**
     * Gets the underlying stream that interfaces with a backing store.
     * @access public
     * @return Stream The stream this StreamWriter is writing to.
     */
    public function baseStream() {
        return new FileStream($this->fileName);
    }


    /**
     * Clears all buffers for the current writer and causes any buffered data to be written to the underlying device.
     * @access public
     * @return void
     */
    public function flush() {
        fflush($this->resource);
    }


    /**
     * Writes the text representation of an object to the text stream by calling ToString on that object.
     * @access public
     * @throws ObjectDisposedException|IOException
     * @param object $value The object to write.
     * @return void
     */
    public function write($value) {
        if(!isset($this->resource)) throw new ObjectDisposedException("The System.IO.TextWriter is closed.");
        try {
            fwrite($this->resource, $value);
            if($this->autoFlush())
                $this->flush();
        } catch(\Exception $e) {
            throw new IOException("An I/O error occurs.");
        }
    }

    /**
     * Writes the text representation of an object by calling ToString on this object, followed by a line terminator to the text stream.
     * @access public
     * @throws ObjectDisposedException|IOException
     * @param $value The object to write. If value is null, only the line termination characters are written.
     * @return void
     */
    public function writeLine($value) {
        $this->write($value.$this->newLine().'\r\n');
    }

    /**
     * When overridden in a derived class, returns the System.Text.Encoding in which the output is written.
     * @access public
     * @return Encoding The Encoding in which the output is written.
     */
    public function encoding() { }
}
?>
