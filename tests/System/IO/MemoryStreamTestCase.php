<?php

use \System\IO\MemoryStream as MemoryStream;
use \System\IO\SeekOrigin as SeekOrigin;

/**
 * group io
*/
class MemoryStreamTestCase extends PHPUnit_Framework_TestCase {

    protected $memoryStream;

    public function setUp() {
        $this->memoryStream = new MemoryStream(array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p'));
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function Construct_ThrowExceptionWhenBufferIsNull() {

        # Act:
        new MemoryStream(null);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Construct_ThrowsExceptionWhenIndexIsLessThanZero() {

        # Arrange:
        $array = array();

        # Act:
        new MemoryStream($array, -1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Construct_ThrowsExceptionWhenCountIsLessThanZero() {

        # Arrange:
        $array = array();

        # Act:
        new MemoryStream($array, 1, -1);
    }

    /**
     * @test
    */
    public function Construct_CanCreateFromBuffer() {

        # Arrange:
        $array = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');

        # Act:
        $stream = new MemoryStream($array);

        # Assert:
        $this->assertEquals(11, $stream->length());
    }

    /**
     * @test
    */
    public function Construct_CanCreateFromPartOfBuffer() {

        # Arrange:
        $array = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');

        # Act:
        $stream = new MemoryStream($array, 2, 3);

        # Assert:
        $this->assertEquals(3, $stream->length());
    }

    /**
     * @test
    */
    public function Construct_CreateFromOffset() {

        # Arrange:
        $array = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');

        # Act:
        $stream = new MemoryStream($array, 2);

        # Assert:
        $this->assertEquals(9, $stream->length());
    }

    /**
     * @test
    */
    public function Construct_CanCreateWithoutBuffer() {

        # Arrange:
        $stream = new MemoryStream();

        # Act:
        $this->assertEquals(0, $stream->length());
    }

    /**
     * @test
    */
    public function CanRead_ShouldBeTrueIfStreamIsOpen() {

        # Arrange:
        $stream = new MemoryStream();

        # Act:
        $this->assertTrue($stream->canRead());
    }

    /**
     * @test
    */
    public function CanRead_ShouldBeFalseIfStreamIsClosed() {

        # Arrange:
        $stream = new MemoryStream();
        $stream->dispose();

        # Act:
        # Assert:
        $this->assertFalse($stream->canRead());
    }

    /**
     * @test
    */
    public function CanWrite_CanCreateStreamNonWritable() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $stream = new MemoryStream($buffer, 0, sizeof($buffer), false);

        # Act:
        # Assert:
        $this->assertFalse($stream->canWrite());
    }

    /**
     * @test
    */
    public function CanWrite_CanCreateStreamWritable() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $stream = new MemoryStream($buffer, 0, sizeof($buffer), true);

        # Act:
        # Assert:
        $this->assertTrue($stream->canWrite());
    }

    /**
     * @test
    */
    public function CanSeek_ShouldBeTrueIfStreamIsOpen() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $stream = new MemoryStream($buffer);

        # Act:
        # Assert:
        $this->assertTrue($stream->canSeek());
    }

    /**
     * @test
    */
    public function CanSeek_ShouldBeFalseIfStreamIsClosed() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);
        $ms->dispose();

        # Act:
        # Assert:
        $this->assertFalse($ms->canSeek());
    }

    /**
     * @test
    */
    public function Capacity_CanGetCapacity(){

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);
        $ms->dispose();

        # Act:
        # Assert:
        $this->assertEquals(11, $ms->capacity());
    }

    /**
     * @test
    */
    public function Capacity_CanSetCapacity() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        $ms->capacity(10);

        # Assert:
        $this->assertEquals(10, $ms->capacity());
    }

    /**
     * @test
    */
    public function Capacity_SetCapacityShouldTruncateMemoryStream() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        $ms->capacity(10);

        # Assert:
        $this->assertEquals(10, $ms->length());
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Position_ThrowsExceptionWhenValueIsLessThanZero() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        $ms->position(-1);
    }

    /**
     * @test
     * @expectedException \System\ObjectDisposedException
    */
    public function Position_ThrowsExceptionWhenMemoryIsClosed() {
        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);
        $ms->close();

        # Act:
        $ms->position(0);
    }

    /**
     * @test
    */
    public function Position_ShouldBeZeroWhenOpenedMemory() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        # Assert:
        $this->assertEquals(0, $ms->position());
    }

    /**
     * @test
    */
    public function Position_ShouldChangePosition() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        $ms->position(2);

        # Assert:
        $this->assertEquals(2, $ms->position());
    }

     /**
     * @test
     * @expectedException \System\ObjectDisposedException
    */
    public function Read_ThrowsExceptionWhenMemoryIsClosed() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);
        $ms->close();

        # Act:
        $content = $ms->read();
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Read_ThrowsExceptionWhenOffsetIsNegative() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        $content = $ms->read(-1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Read_ThrowsExceptionWhenCountIsNegative() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        $content = $ms->read(0, -1);
    }

    /**
     * @test
    */
    public function Read_CanReadFromBuffer() {
        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        $content = $ms->read();

        # Assert:
        $this->assertEquals('dotnetonphp', implode($content));
    }

    /**
     * @test
    */
    public function Read_CanReadPartOfBuffer() {
        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        $content = $ms->read(3);

        # Assert:
        $this->assertEquals('netonphp', implode($content));
    }

    /**
     * @test
    */
    public function Read_CanReadBlockOfBuffer() {
        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        $content = $ms->read(3, 3);

        # Assert:
        $this->assertEquals('net', implode($content));
    }

    // /**
    //  * @test
    // */
    // public function ReadByte_ThrowsExceptionWhenStreamIsClosed() {
    //     $this->setExpectedException("\\System\\ObjectDisposedException");
    //     $this->memoryStream->close();
    //     $this->memoryStream->readByte();
    // }

    // /**
    //  * @test
    // */
    // public function ReadByte_CanReadNextCharacter() {
    //     $this->assertNotNull($this->memoryStream->readByte());
    // }

    // /**
    //  * @test
    // */
    // public function Seek_ThrowsExceptionWhenStreamIsClosed() {
    //     $this->setExpectedException("\\System\\ObjectDisposedException");
    //     $this->memoryStream->close();
    //     $this->memoryStream->seek(2);
    // }

    // /**
    //  * @test
    // */
    // public function Seek_PositionShouldBeEqualTwo() {
    //     $this->memoryStream->seek(2, SeekOrigin::Begin);
    //     $this->assertEquals(2, $this->memoryStream->position());
    // }

    // /**
    //  * @test
    // */
    // public function Seek_PositionShouldBeEqualFour() {
    //     $this->memoryStream->seek(2, SeekOrigin::Begin);
    //     $this->memoryStream->seek(2, SeekOrigin::Current);
    //     $this->assertEquals(4, $this->memoryStream->position());
    // }

    // /**
    //  * @test
    // */
    // public function Seek_PositionShouldBeEqualFortyThree() {
    //     $this->memoryStream->seek(0, SeekOrigin::End);
    //     $this->assertEquals(11, $this->memoryStream->position());
    // }

    // /**
    //  * @test
    // */
    // public function SetLength_ThrowsExceptionWhenSizeIsGreaterThanCapacity() {
    //     $this->setExpectedException("\\System\\NotSupportedException");
    //     $this->memoryStream->setLength(30);
    // }

    // /**
    //  * @test
    // */
    // public function SetLength_ThrowsExceptionWhenStreamIsNotWritable() {
    //     $this->setExpectedException("\\System\\NotSupportedException");
    //     $ms = new MemoryStream(array('dotnetonphp'), 0, 1, false);
    //     $ms->setLength(1);
    // }

    // /**
    //  * @test
    // */
    // public function SetLength_ThrowsExceptionWhenValueIsLessThanZero() {
    //     $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
    //     $this->memoryStream->setLength(-1);
    // }

    // /**
    //  * @test
    // */
    // public function SetLength_CanTruncateMemoryStream() {
    //     $this->memoryStream->setLength(2);
    //     $this->assertEquals(2, $this->memoryStream->length());
    // }

    // /**
    //  * @test
    // */
    // public function ToArray_ShouldReturnEmptyWhenStreamIsClosed() {
    //     $this->memoryStream->close();
    //     $this->assertEquals(array(), $this->memoryStream->toArray());
    // }

    // /**
    //  * @test
    // */
    // public function ToArray_ShouldReturnBuffer() {
    //     $this->memoryStream->close();
    //     $buffer = $this->memoryStream->toArray();
    //     $this->assertNotNull($buffer);
    // }

    // /**
    //  * @test
    // */
    // public function Write_ThrowsExceptionWhenArrayIsNull() {
    //     $this->setExpectedException("\\System\\ArgumentNullException");
    //     $this->memoryStream->write(null, 0, 10);
    // }

    // /**
    //  * @test
    // */
    // public function Write_ThrowsExceptionWhenOffsetIsInvalidRage() {
    //     $this->setExpectedException("\\System\\ArgumentException");
    //     $array = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
    //     $this->memoryStream->write($array, 55, 10);
    // }

    // /**
    //  * @test
    // */
    // public function Write_ThrowsExceptionWhenOffsetIsNegative() {
    //     $this->setExpectedException("\\System\\ArgumentOutOfRangeException");
    //     $array = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
    //     $this->memoryStream->write($array, -1, 10);
    // }

    // /**
    //  * @test
    // */
    // public function Write_CanWriteInRange() {
    //     $array = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
    //     $this->memoryStream->write($array, 0, 3);
    //     $this->memoryStream->seek(0, SeekOrigin::Begin);
    //     $this->assertEquals('d', $this->memoryStream->readByte());
    //     $this->assertEquals('o', $this->memoryStream->readByte());
    //     $this->assertEquals('t', $this->memoryStream->readByte());
    // }

    // /**
    //  * @test
    // */
    // public function WriteByte_ThrowsExceptionWhenMemoryIsReadOnly() {
    //     $this->setExpectedException("\\System\\NotSupportedException");
    //     $ms = new MemoryStream(array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p'), 0, 1, false);
    //     $ms->writeByte('a');
    // }

    // /**
    //  * @test
    // */
    // public function WriteByte_ThrowsExceptionWhenMemoryWasDisposed() {
    //     $this->setExpectedException("\\System\\ObjectDisposedException");
    //     $ms = new MemoryStream(array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p'));
    //     $ms->close();
    //     $ms->writeByte('a');
    // }

    // /**
    //  * @test
    // */
    // public function WriteByte_WhenWriteThePositionShouldBeMoved() {
    //     $ms = new MemoryStream(array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p'));
    //     $ms->writeByte('a');
    //     $this->assertEquals(1, $ms->position());
    // }

    // /**
    //  * @test
    // */
    // public function WriteByte_CanWriteByte() {
    //     $ms = new MemoryStream(array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p'));
    //     $ms->writeByte('a');
    //     $ms->position(0);
    //     $this->assertEquals('a', $ms->readByte());
    // }
}
