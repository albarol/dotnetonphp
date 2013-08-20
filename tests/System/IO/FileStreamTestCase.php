<?php

use \System\IO\FileStream as FileStream;
use \System\IO\FileMode as FileMode;
use \System\IO\FileAccess as FileAccess;
use \System\IO\SeekOrigin as SeekOrigin;
 
/**
 * @group io
*/
class FileStreamTestCase extends PHPUnit_Framework_TestCase {

    private $filename;

    private function generateName() {
        return '/tmp/' . md5(rand(1, 20).rand(21, 70).rand(71, 100));
    }

    private function generateFile() {
        $filename = $this->generateName();
        $fd = fopen($filename, 'w');
        fwrite($fd, 'dotnetonphp');
        fclose($fd);
        return $filename;
    }

    public function setUp() {
        $this->filename = $this->generateFile();
    }

    public function tearDown() {
        unlink($this->filename);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function Constructor_ThrowsExceptionWhenPathIsNull() {
        # Arrange:
        # Act:
        new FileStream(null);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function Constructor_ThrowsExceptionWhenPathIsEmpty() {
        # Arrange:
        # Act:
        new FileStream("");
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function Constructor_ThrowsExceptionWhenFileNotFound() {
        # Arrange:
        # Act:
        new FileStream('file_not_found.txt');
    }

    /**
     * @test
    */
    public function CanRead_ShouldBeTrueIfFileWasOpenedInReadMode() {
        # Act:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::read());

        # Assert:
        $this->assertTrue($fs->canRead());
    }

    /**
     * @test
    */
    public function CanRead_ShouldBeFalseIfFileWasOpenedToWriteOnly() {
        # Act:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::write());

        # Assert:
        $this->assertFalse($fs->canRead());
    }

    /**
     * @test
    */
    public function CanSeek_ShouldBeTrueIfStreamIsOpened() {
        # Act:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::read());

        # Assert:
        $this->assertTrue($fs->canSeek());
    }

    /**
     * @test
    */
    public function CanSeek_ShouldBeFalseIfStreamIsClosed() {
        # Arrange:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::read());

        # Act:
        $fs->close();

        # Act:
        $this->assertFalse($fs->canSeek());
    }

    /**
     * @test
    */
    public function CanTimeOut_AlwaysBeFalseBecauseFileStreamNotSupported() {
        # Act:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::read());

        # Assert:
        $this->assertFalse($fs->canTimeout());
    }

    /**
     * @test
    */
    public function CanWrite_ShouldBeFalseIfFileWasOpenedInReadMode() {
        # Act:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::read());

        # Assert:
        $this->assertFalse($fs->canWrite());
    }

    /**
     * @test
    */
    public function CanWrite_ShouldBeTrueIfFileWasOpenedInWriteMode() {
        # Act:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::write());

        # Assert:
        $this->assertTrue($fs->canWrite());
    }

    /**
     * @test
    */
    public function Length_CanGetLengthOfStream() {
        # Arrange:
        # Act:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::read());

        # Arrange:
        $this->assertGreaterThan(0, $fs->length());
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Position_ThrowsExceptionWhenValueIsLessThanZero() {
        # Arrange:
        # Act:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::read());

        # Assert:
        $fs->position(-1);
    }

    /**
     * @test
     * @expectedException \System\IO\IOException
    */
    public function Position_ThrowsExceptionWhenStreamIsClosed() {
        # Arrange:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::read());
        $fs->close();

        # Act:
        $fs->position();
    }

    /**
     * @test
    */
    public function Position_ShouldBeZeroWhenOpenedFile() {

        # Arrange:
        # Act:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::read());

        # Assert:
        $this->assertEquals(0, $fs->position());
    }

    /**
     * @test
    */
    public function Position_ShouldChangePosition() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::read());

        # Act:
        $fs->position(2);

        # Assert:
        $this->assertEquals(2, $fs->position());
    }

    /**
     * @test
     * @expectedException \System\ObjectDisposedException
    */
    public function Lock_ThrowsExceptionWhenFileIsClosed() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::read());
        $fs->close();

        # Act:
        $fs->lock();
    }

    /**
     * @test
     * @expectedException \System\ObjectDisposedException
    */
    public function Read_ThrowsExceptionWhenStreamIsClosed() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::read());
        $fs->close();

        # Act:
        $fs->read(0, 1);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Read_ThrowsExceptionWhenOffsetIsNegative() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::read());

        # Act:
        $fs->read(-1, 1);
    }

    /**
     * @test
    */
    public function Read_CanReadBuffer() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::read());

        # Act:
        $array = $fs->read(0, 4);

        # Assert:
        $this->assertEquals(4, sizeof($array));
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function Read_ThrowsExceptionIfStreamNotSupportRead() {
        
        # Arrange:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::write());

        # Act:
        $fs->read();
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function ReadByte_ThrowsExceptionIfStreamNotSupportRead() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::write());

        # Act:
        $fs->readByte();
    }

    /**
     * @test
     * @expectedException \System\ObjectDisposedException
    */
    public function ReadByte_ThrowsExceptionWhenStreamIsClosed() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::read());
        $fs->close();

        # Act:
        $fs->readByte();
    }

    /**
     * @test
     * @group implement
    */
    public function ReadByte_CanReadNextCharacter() {
        
        # Arrange:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::read());
        $letter = 'd';

        # Act:
        $result = $fs->readByte();

        # Assert:
        $this->assertEquals($letter, $result);
    }

    /**
     * @test
     * @expectedException \System\InvalidOperationException
    */
    public function ReadTimeOut_ThrowsExceptionInvalidOperation() {

        # Arrange: 
        $fs = new FileStream($this->filename, FileMode::append(), FileAccess::readWrite());

        # Act:
        $fs->readTimeout();
    }

    /**
     * @test
     * @expectedException \System\ObjectDisposedException
    */
    public function Seek_ThrowsExceptionWhenStreamIsClosed() {
        # Arrange:
        $fs = new FileStream($this->filename, FileMode::append(), FileAccess::readWrite());
        $fs->close();

        # Act:
        $fs->seek(2);
    }

    /**
     * @test
    */
    public function Seek_PositionShouldBeEqualTwo() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::readWrite());

        # Act:
        $fs->seek(2);

        # Assert:
        $this->assertEquals(2, $fs->position());
    }

    /**
     * @test
    */
    public function Seek_PositionShouldBeEqualFour() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::readWrite());

        # Act:
        $fs->seek(2, SeekOrigin::begin());
        $fs->seek(2, SeekOrigin::current());

        # Assert:
        $this->assertEquals(4, $fs->position());
    }

    /**
     * @test
    */
    public function Seek_PositionShouldBeEqualFortyThree() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::readWrite());

        # Act:
        $fs->seek(1, SeekOrigin::end());

        # Assert:
        $this->assertEquals(10, $fs->position());
    }

    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function SetLength_ThrowsExceptionWhenFileIsReadMode() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::open(), FileAccess::read());

        # Act:
        $fs->setLength(10);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function SetLength_ThrowsExceptionWhenValueIsLessThanZero() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::write());

        # Act:
        $fs->setLength(-1);
    }

    /**
     * @test
    */
    public function SetLength_CanTruncateFileStream() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::write());

        # Act:
        $fs->setLength(2);

        # Assert:
        $this->assertEquals(2, $fs->length());
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function Write_ThrowsExceptionWhenArrayIsNull() {
        # Arrange:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::write());

        # Act:
        $fs->write(null, 0, 10);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function Write_ThrowsExceptionWhenOffsetIsInvalidRage() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::write());
        $array = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');
        
        # Act:
        $fs->write($array, 55, 10);
    }

    /**
     * @test
     * @expectedException \System\ArgumentOutOfRangeException
    */
    public function Write_ThrowsExceptionWhenOffsetIsNegative() {
        # Arrange:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::write());
        $array = array('d', 'o', 't', 'n', 'e', 't', 'o', 'n', 'p', 'h', 'p');

        # Act:
        $fs->write($array, -1, 10);
    }

    /**
     * @test
    */
    public function Write_CanWriteInRange() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::readWrite());
        $fs->setLength(0);
        $array = array('p', 'h', 'p', 'a', 'n', 'd', 'n', 'e', 't');

        # Act:
        $fs->write($array, 0, 3);

        # Assert:
        $fs->seek(0);
        $this->assertEquals(3, sizeof($fs->read()));
    }

    /**
     * @test
    */
    public function Write_CanWriteEntireArray() {
    
        # Arrange:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::readWrite());
        $fs->setLength(0);
        $array = array('p', 'h', 'p', 'a', 'n', 'd', 'n', 'e', 't');
    
        # Act:
        $fs->write($array);
    
        # Assert:
        $this->assertEquals(9, sizeof($fs->read()));
    }


    /**
     * @test
     * @expectedException \System\NotSupportedException
    */
    public function WriteByte_ThrowsExceptionWhenFileIsOpenedInReadMode() {
        # Arrange:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::read());

        # Act:
        $fs->writeByte('a');
    }

    /**
     * @test
     * @expectedException \System\ObjectDisposedException 
    */
    public function WriteByte_ThrowsExceptionWhenFileWasDisposed() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::write());
        $fs->close();

        # Act:
        $fs->writeByte('a');
    }

    /**
     * @test
    */
    public function WriteByte_CanWriteByte() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::openOrCreate(), FileAccess::readWrite());
        $fs->setLength(0);

        # Act:
        $fs->writeByte(0x1);

        # Assert:
        $fs->seek(0);
        $this->assertEquals(0x1, $fs->readByte());
    }

    /**
     * @test
     * @expectedException \System\InvalidOperationException
    */
    public function WriteTimeOut_ThrowsExceptionInvalidOperation() {

        # Arrange:
        $fs = new FileStream($this->filename, FileMode::append(), FileAccess::readWrite());

        # Act:
        $fs->writeTimeout();
    }

}
