<?php

require_once dirname(__FILE__) . '/../../../src/Autoloader.php';

use \System\IO\MemoryStream as MemoryStream;
use \System\IO\SeekOrigin as SeekOrigin;

class MemoryStreamFixture extends PHPUnit_Framework_TestCase {

    protected $memoryStream;

    public function setUp() {
        $this->memoryStream = new MemoryStream(array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p'));
    }

    public function test_Construct_ThrowExceptionWhenBufferIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        new MemoryStream(null);
    }

    public function test_Construct_ThrowsExceptionWhenIndexIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = array();
        new MemoryStream($array, -1);
    }

    public function test_Construct_ThrowsExceptionWhenCountIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = array();
        new MemoryStream($array, 1, -1);
    }

    public function test_Construct_CanCreateFromBuffer() {
        $array = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $stream = new MemoryStream($array);
        $this->assertEquals(11, $stream->length());
    }

    public function test_Construct_CanCreateFromPartOfBuffer() {
        $array = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $stream = new MemoryStream($array, 2, 3);
        $this->assertEquals(3, $stream->length());
    }

    public function test_Construct_CanCreateWithoutBuffer() {
        $stream = new MemoryStream();
        $this->assertEquals(0, $stream->length());
    }

    public function test_CanRead_ShouldBeTrueIfStreamIsOpen() {
        $stream = new MemoryStream();
        $this->assertTrue($stream->canRead());
    }

    public function test_CanRead_ShouldBeFalseIfStreamIsClosed() {
        $stream = new MemoryStream();
        $stream->dispose();
        $this->assertFalse($stream->canRead());
    }

    public function test_CanWrite_CanCreateStreamNonWritable() {
        $array = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $stream = new MemoryStream($array, 2, 3, false);
        $this->assertFalse($stream->canWrite());
    }

    public function test_CanWrite_CanCreateStreamWritable() {
        $array = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $stream = new MemoryStream($array, 2, 3, true);
        $this->assertTrue($stream->canWrite());
    }

    public function test_CanSeek_ShouldBeTrueIfStreamIsOpen() {
        $this->assertTrue($this->memoryStream->canSeek());
    }

    public function test_CanSeek_ShouldBeFalseIfStreamIsClosed() {
        $this->memoryStream->dispose();
        $this->assertFalse($this->memoryStream->canSeek());
    }

    public function test_Capacity_CanGetCapacity(){
        $this->assertEquals(11, $this->memoryStream->capacity());
    }

    public function test_Capacity_CanSetCapacity() {
        $this->memoryStream->capacity(10);
        $this->assertEquals(10, $this->memoryStream->capacity());
    }

    public function test_Position_ThrowsExceptionWhenValueIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $this->memoryStream->position(-1);
    }

    public function test_Position_ThrowsExceptionWhenMemoryIsClosed() {
        $this->setExpectedException("\\System\\ObjectDisposedException");
        $this->memoryStream->close();
        $this->memoryStream->position();
    }

    public function test_Position_ShouldBeZeroWhenOpenedMemory() {
        $this->assertEquals(0, $this->memoryStream->position());
    }

    public function test_Position_ShouldChangePosition() {
        $this->memoryStream->position(2);
        $this->assertEquals(2, $this->memoryStream->position());
    }
     public function test_Read_ThrowsExceptionWhenMemoryIsClosed() {
        $this->setExpectedException("\\System\\ObjectDisposedException");
        $this->memoryStream->close();
        $array = array();
        $this->memoryStream->read($array, 0, 1);
    }

    public function test_Read_ThrowsExceptionWhenOffsetIsNegative() {
        $this->setExpectedException("\\System\\ArgumentException");
        $array = array();
        $this->memoryStream->read($array, -1, 1);
    }

    public function test_Read_CanReadBuffer() {
        $array = array();
        $this->memoryStream->read($array, 0, 4);
        $this->assertEquals(4, sizeof($array));
    }

    public function test_ReadByte_ThrowsExceptionWhenStreamIsClosed() {
        $this->setExpectedException("\\System\\ObjectDisposedException");
        $this->memoryStream->close();
        $this->memoryStream->readByte();
    }

    public function test_ReadByte_CanReadNextCharacter() {
        $this->assertNotNull($this->memoryStream->readByte());
    }
    
    public function test_Seek_ThrowsExceptionWhenStreamIsClosed() {
        $this->setExpectedException("\\System\\ObjectDisposedException");
        $this->memoryStream->close();
        $this->memoryStream->seek(2);
    }

    public function test_Seek_PositionShouldBeEqualTwo() {
        $this->memoryStream->seek(2, SeekOrigin::Begin);
        $this->assertEquals(2, $this->memoryStream->position());
    }

    public function test_Seek_PositionShouldBeEqualFour() {
        $this->memoryStream->seek(2, SeekOrigin::Begin);
        $this->memoryStream->seek(2, SeekOrigin::Current);
        $this->assertEquals(4, $this->memoryStream->position());
    }

    public function test_Seek_PositionShouldBeEqualFortyThree() {
        $this->memoryStream->seek(0, SeekOrigin::End);
        $this->assertEquals(11, $this->memoryStream->position());
    }

    public function test_SetLength_ThrowsExceptionWhenSizeIsGreaterThanCapacity() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $this->memoryStream->setLength(30);
    }

    public function test_SetLength_ThrowsExceptionWhenStreamIsNotWritable() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $ms = new MemoryStream(array('dotnetonphp'), 0, 1, false);
        $ms->setLength(1);
    }

    public function test_SetLength_ThrowsExceptionWhenValueIsLessThanZero() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $this->memoryStream->setLength(-1);
    }

    public function test_SetLength_CanTruncateMemoryStream() {
        $this->memoryStream->setLength(2);
        $this->assertEquals(2, $this->memoryStream->length());
    }

    public function test_ToArray_ShouldReturnEmptyWhenStreamIsClosed() {
        $this->memoryStream->close();
        $this->assertEquals(array(), $this->memoryStream->toArray());
    }

    public function test_ToArray_ShouldReturnBuffer() {
        $this->memoryStream->close();
        $buffer = $this->memoryStream->toArray();
        $this->assertNotNull($buffer);
    }

    public function test_Write_ThrowsExceptionWhenArrayIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        $this->memoryStream->write(null, 0, 10);
    }

    public function test_Write_ThrowsExceptionWhenOffsetIsInvalidRage() {
        $this->setExpectedException("\\System\\ArgumentException");
        $array = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $this->memoryStream->write($array, 55, 10);
    }

    public function test_Write_ThrowsExceptionWhenOffsetIsNegative() {
        $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
        $array = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $this->memoryStream->write($array, -1, 10);
    }

    public function test_Write_CanWriteInRange() {
        $array = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $this->memoryStream->write($array, 0, 3);
        $this->memoryStream->seek(0, SeekOrigin::Begin);
        $this->assertEquals('d', $this->memoryStream->readByte());
        $this->assertEquals('o', $this->memoryStream->readByte());
        $this->assertEquals('t', $this->memoryStream->readByte());
    }

    public function test_WriteByte_ThrowsExceptionWhenMemoryIsReadOnly() {
        $this->setExpectedException("\\System\\NotSupportedException");
        $ms = new MemoryStream(array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p'), 0, 1, false);
        $ms->writeByte('a');
    }

    public function test_WriteByte_ThrowsExceptionWhenMemoryWasDisposed() {
        $this->setExpectedException("\\System\\ObjectDisposedException");
        $ms = new MemoryStream(array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p'));
        $ms->close();
        $ms->writeByte('a');
    }

    public function test_WriteByte_WhenWriteThePositionShouldBeMoved() {
        $ms = new MemoryStream(array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p'));
        $ms->writeByte('a');
        $this->assertEquals(1, $ms->position());
    }

    public function test_WriteByte_CanWriteByte() {
        $ms = new MemoryStream(array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p'));
        $ms->writeByte('a');
        $ms->position(0);
        $this->assertEquals('a', $ms->readByte());
    }


}
?>