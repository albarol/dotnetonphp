<?php

use \System\IO\MemoryStream as MemoryStream;
use \System\IO\SeekOrigin as SeekOrigin;

/**
 * group io
*/
class MemoryStreamTestCase extends PHPUnit_Framework_TestCase {

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

    /**
     * @test
     * @expectedException \System\ObjectDisposedException
    */
    public function ReadByte_ThrowsExceptionWhenStreamIsClosed() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);
        $ms->close();

        # Act:
        $ms->readByte();
    }

    /**
     * @test
    */
    public function ReadByte_CanReadNextCharacter() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        # Assert:
        $this->assertEquals('d', $ms->readByte());
        $this->assertEquals('o', $ms->readByte());
    }

    /**
     * @test
     * @expectedException \System\ObjectDisposedException
    */
    public function Seek_ThrowsExceptionWhenStreamIsClosed() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);
        $ms->close();

        # Act:
        # Assert:
        $ms->seek(0);
    }

    /**
     * @test
     * @expectedException \System\IO\IOException
    */
    public function Seek_ThrowsExceptionWhenValueIsBeforeBeginOfStream() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        # Assert:
        $ms->seek(-1);
    }

    /**
     * @test
    */
    public function Seek_CanSetPositionFromBegin() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        $ms->seek(2, SeekOrigin::begin());

        # Assert:
        $this->assertEquals('t', $ms->readByte());
    }

    /**
     * @test
    */
    public function Seek_CanSetPositionFromCurrent() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);
        $ms->seek(2, SeekOrigin::begin());

        # Act:
        $ms->seek(2, SeekOrigin::current());

        # Assert:
        $this->assertEquals('e', $ms->readByte());
    }

    /**
     * @test
    */
    public function Seek_PositionShouldBeEqualFortyThree() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        $ms->seek(2, SeekOrigin::end());

        # Assert:
        $this->assertEquals('h', $ms->readByte());
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function SetLength_ThrowsExceptionWhenSizeIsGreaterThanCapacity() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        $ms->setLength(30);
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function SetLength_ThrowsExceptionWhenStreamIsNotWritable() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer, 0, 11, false);

        # Act:
        $ms->setLength(1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function SetLength_ThrowsExceptionWhenValueIsLessThanZero() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        $ms->setLength(-1);
    }

    /**
     * @test
    */
    public function SetLength_CanTruncateMemoryStream() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        $ms->setLength(2);

        # Assert:
        $this->assertEquals(2, $ms->length());
    }

    /**
     * @test
    */
    public function ToArray_ShouldReturnEmptyWhenStreamIsClosed() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);
        $ms->close();

        # Act:
        # Assert:
        $this->assertEquals(array(), $ms->toArray());
    }

    /**
     * @test
    */
    public function ToArray_ShouldReturnBuffer() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream($buffer);

        # Act:
        $content = $ms->toArray();

        # Assert:
        $this->assertEquals('dotnetonphp', implode($content));
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function Write_ThrowsExceptionWhenArrayIsNull() {

        # Arrange:
        $ms = new MemoryStream();

        # Act:
        $ms->write(null);
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function Write_ThrowsExceptionWhenStreamIsReadOnly() {

        # Arrange:
        $ms = new MemoryStream(array('dot'), 0, 0, false);

        # Act:
        $ms->write('netonphp');
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function Write_ThrowsExceptionWhenOffsetIsInvalidRage() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream();

        # Act:
        $ms->write($buffer, 15, 10);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Write_ThrowsExceptionWhenOffsetIsNegative() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream();

        # Act:
        $ms->write($buffer, -1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Write_ThrowsExceptionWhenCountIsNegative() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream();

        # Act:
        $ms->write($buffer, 0, -1);
    }

    /**
     * @test
     * @expectedException \System\ObjectDisposedException
    */
    public function Write_ThrowsExceptionWhenStreamIsClosed() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream();
        $ms->close();

        # Act:
        $ms->write($buffer);
    }

    /**
     * @test
    */
    public function Write_FillStreamWithBuffer() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream();

        # Act:
        $ms->write($buffer);

        # Arrange:
        $this->assertEquals(11, $ms->position());
    }

    /**
     * @test
    */
    public function Write_StartFromOffset() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream();

        # Act:
        $ms->write($buffer, 5);

        # Arrange:
        $this->assertEquals(6, $ms->position());
    }

    /**
     * @test
    */
    public function Write_CountNumberOfItems() {

        # Arrange:
        $buffer = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        $ms = new MemoryStream();

        # Act:
        $ms->write($buffer, 5, 3);

        # Arrange:
        $this->assertEquals(3, $ms->position());
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function WriteByte_ThrowsExceptionWhenMemoryIsReadOnly() {

        # Arrange:
        $ms = new MemoryStream(array(), 0, 0, false);

        # Act:
        $ms->writeByte('a');
    }

    /**
     * @test
     * @expectedException \System\ObjectDisposedException
    */
    public function WriteByte_ThrowsExceptionWhenMemoryWasDisposed() {

        # Arrange:
        $ms = new MemoryStream();
        $ms->close();

        # Act:
        $ms->writeByte('a');
    }

    /**
     * @test
    */
    public function WriteByte_WhenWriteThePositionShouldBeMoved() {

        # Arrange:
        $ms = new MemoryStream();

        # Act:
        $ms->writeByte('a');

        # Assert:
        $this->assertEquals(1, $ms->position());
    }

    /**
     * @test
    */
    public function WriteByte_CanWrite() {

        # Arrange:
        $ms = new MemoryStream();

        # Act:
        $ms->writeByte('a');

        # Assert:
        $ms->seek(0);
        $this->assertEquals('a', $ms->readByte());
    }

    /**
     * @test
     * @expectedException \System\ObjectDisposedException
    */
    public function WriteTo_ThrowsExceptionWhenCurrentIsClosed() {

        # Arrange:
        $ms = new MemoryStream();
        $ms2 = new MemoryStream();
        $ms->close();

        # Act:
        $ms->writeTo($ms2);
    }

    /**
     * @test
     * @expectedException \System\ObjectDisposedException
    */
    public function WriteTo_ThrowsExceptionWhenTargetIsClosed() {

        # Arrange:
        $ms = new MemoryStream(array("dotnetonphp"));
        $ms2 = new MemoryStream();
        $ms2->close();

        # Act:
        $ms->writeTo($ms2);
    }

    /**
     * @test
    */
    public function WriteTo_CopyValuesToAnotherStream() {

        # Arrange:
        $ms = new MemoryStream(array("dotnetonphp"));
        $ms2 = new MemoryStream();

        # Act:
        $ms->writeTo($ms2);

        # Assert:
        $ms2->seek(0);
        $this->assertEquals('dotnetonphp', implode($ms2->read()));
    }
}
