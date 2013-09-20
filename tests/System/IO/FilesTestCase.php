<?php


use \System\DateTime as DateTime;
use \System\IO\Files as Files;
use \System\IO\FileMode as FileMode;
use \System\IO\FileAccess as FileAccess;
use \System\IO\FileStream as FileStream;
use \System\IO\StreamReader as StreamReader;

/**
 * group io
**/
class FilesTestCase extends PHPUnit_Framework_TestCase {

    private function generateName()
    {
        return '/tmp/'.md5(rand(1, 20).rand(22, 45).rand(51, 100)).'.txt';
    }

    private function generateFile()
    {
        $filename = $this->generateName();
        $fd = fopen($filename, 'w');
        fwrite($fd, 'dotnetonphp');
        fclose($fd);
        return $filename;
    }

    private function generateFileWithBreakLine()
    {
        $filename = $this->generateName();
        $fd = fopen($filename, 'w');
        fwrite($fd, str_repeat('dotnetonphp'.PHP_EOL, 10));
        fclose($fd);
        return $filename;
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function AppendAllText_ThrowsExceptionWhenPathIsNull() {

        # Act:
        Files::appendAllText(null, "dotnetonphp");
    }

    /**
     * @test
     * @expectedException \System\IO\PathTooLongException
    */
    public function AppendAllText_ThrowsExceptionWhenPathIsLong() {

        # Arrange:
        $filename = '/tmp/'.str_repeat('dotnetonphp', 30);

        # Act:
        Files::appendAllText($filename, "dotnetonphp");
    }

    /**
     * @test
    */
    public function AppendAllText_CanAppendText() {

        # Arrange:
        $filename = $this->generateFile();

        # Act:
        Files::appendAllText($filename, "dotnetonphp");

        # Assert:
        $content = Files::readAllLines($filename);
        $this->assertEquals("dotnetonphp", implode($content));
    }

    /**
     * @test
    */
    public function AppendText_CanAppendTextInFile() {

        # Arrange:
        $filename = $this->generateFile();

        # Act:
        $sw = Files::appendText($filename);
        $sw->write("--");
        $sw->dispose();

        # Assert:
        $content = Files::readAllLines($filename);
        $this->assertEquals('dotnetonphp--', implode($content));
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function Copy_ThrowsExceptionWhenFileNotFound() {
        # Arrange:
        $fromFile = $this->generateName();
        $toFile = $this->generateName();

        # Act:
        Files::copy($fromFile, $toFile);
    }

    /**
     * @test
     * @expectedException \System\IO\IOException
    */
    public function Copy_ThrowsExceptionWhenFileExists() {

        # Arrange:
        $fromFile = $this->generateFile();
        $toFile = $this->generateFile();

        Files::copy($fromFile, $toFile);

    }

    /**
     * @test
    */
    public function Copy_CanCopyFile() {

        # Arrange:
        $fromFile = $this->generateFile();
        $toFile = $this->generateName();

        # Act:
        Files::copy($fromFile, $toFile);

        # Assert:
        $this->assertFileExists($toFile);
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function Delete_ThrowsExceptionWhenFileNotFound() {
        # Arrange:
        # Act:
        Files::delete("file_not_found.txt");
    }

    /**
     * @test
    */
    public function Delete_CanDeleteFile() {

        # Arrange:
        $tempfile = $this->generateFile();

        # Act:
        Files::delete($tempfile);

        # Assert:
        $this->assertFileNotExists($tempfile);
    }

    /**
     * @test
    */
    public function Exists_ShouldReturnTrueIfFileExists() {

        # Arrange:
        $tempfile = $this->generateFile();

        # Act:
        $exists = Files::exists($tempfile);

        # Assert:
        $this->assertTrue($exists);
    }

    /**
     * @test
    */
    public function Exists_ShouldReturnFalseIfFileExists() {
        # Arrange:
        $tempfile = $this->generateName();

        # Act:
        $exists = Files::exists($tempfile);

        # Assert:
        $this->assertFalse($exists);
    }

    /**
     * @test
    */
    public function GetCreationTime_CanGetCreationTime() {

        # Arrange:
        $now = getdate();
        $tempfile = $this->generateFile();

        # Act:
        $creationTime = Files::getCreationTime($tempfile);

        # Act:
        $this->assertEquals($now['year'], $creationTime->year());
    }

    /**
     * @test
    */
    public function GetCreationTime_CanGetLastAccessTime() {

        # Arrange:
        $now = getdate();
        $tempfile = $this->generateFile();

        # Act:
        $creationTime = Files::getLastAccessTime($tempfile);

        # Act:
        $this->assertEquals($now['year'], $creationTime->year());
    }

    /**
     * @test
    */
    public function GetCreationTime_CanGetLastWriteTime() {

        # Arrange:
        $now = getdate();
        $tempfile = $this->generateFile();

        # Act:
        $creationTime = Files::getLastWriteTime($tempfile);

        # Act:
        $this->assertEquals($now['year'], $creationTime->year());
    }

    /**
     * @test
     * @expectedException \System\IO\IOException
    */
    public function Move_ThrowExceptionWhenDestinationExists() {

        # Arrange:
        $fromFile = $this->generateFile();
        $toFile = $this->generateFile();

        # Act:
        # Assert:
        Files::move($fromFile, $toFile);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function Move_ThrowsExceptionWhenSourceIsNull() {

        # Act:
        # Assert:
        Files::move(null, $this->generateName());
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function Move_ThrowsExceptionWhenDestinationIsNull() {

        # Act:
        # Assert:
        Files::move($this->generateFile(), null);
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function Move_ThrowsExceptionWhenFileNotFound() {

        # Arange:
        $fromFile = $this->generateName();
        $toFile = $this->generateName();

        # Act:
        Files::move($fromFile, $toFile);
    }

    /**
     * @test
    */
    public function Move_CanMoveFile() {

        # Arrange:
        $fromFile = $this->generateFile();
        $toFile = $this->generateName();

        # Act:
        Files::move($fromFile, $toFile);

        # Assert:
        $this->assertFileExists($toFile);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function Open_ThrowsExceptionWhenPathIsNull() {

        # Act:
        Files::open(null);
    }

    /**
     * @test
     * @expectedException \System\IO\PathTooLongException
    */
    public function Open_ThrowsExceptionWhenPathIsLong() {

        # Arrange:
        $path = str_repeat('dotnetonphp', 30);

        # Act:
        Files::open($path);
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function Open_ThrowsExceptionWhenFileNotFound() {

        # Arrange:
        # Act:
        Files::open('/tmp/files.tmp');
    }

    /**
     * @test
    */
    public function Open_CanOpenFile() {

        # Arrange:
        $file = $this->generateFile();

        # Act:
        $fs = Files::open($file);

        # Assert:
        $this->assertTrue($fs instanceof FileStream);
    }

    /**
     * @test
    */
    public function Open_CanOpenFileInWriteMode() {

        # Arrange:
        $file = $this->generateFile();

        # Act:
        $fs = Files::open($file, FileMode::openOrCreate(), FileAccess::write());

        # Assert:
        $this->assertTrue($fs->canWrite());
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function OpenRead_ThrowsExceptionWhenPathIsNull() {

        # Act:
        Files::openRead(null);
    }

    /**
     * @test
     * @expectedException \System\IO\PathTooLongException
    */
    public function OpenRead_ThrowsExceptionWhenPathIsLong() {

        # Arrange:
        $path = str_repeat('dotnetonphp', 30);

        # Act:
        Files::openRead($path);
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function OpenRead_ThrowsExceptionWhenFileNotFound() {

        # Act:
        Files::openRead('/tmp/file_not_found.txt');
    }

    /**
     * @test
    */
    public function OpenRead_CanOpenFileInReadMode() {

        # Arrange:
        $file = $this->generateFile();

        # Act:
        $fs = Files::openRead($file);

        # Assert:
        $this->assertFalse($fs->canWrite());
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function OpenText_ThrowsExceptionWhenPathIsNull() {

        # Act:
        Files::openText(null);
    }

    /**
     * @test
     * @expectedException \System\IO\PathTooLongException
    */
    public function OpenText_ThrowsExceptionWhenPathIsLong() {

        # Arrange:
        $path = str_repeat('dotnetonphp', 30);

        # Act:
        Files::openText($path);
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function OpenText_ThrowsExceptionWhenFileNotFound() {

        # Arrange:
        $path = '/tmp/dotnetonphp.file';

        # Act:
        Files::openText($path);
    }

    /**
     * @test
    */
    public function OpenText_CanOpenFileInReadMode() {

        # Act:
        $sr = Files::openText($this->generateFile());

        # Assert:
        $this->assertTrue($sr instanceof StreamReader);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function OpenWrite_ThrowsExceptionWhenPathIsNull() {

        # Arrange:
        Files::openWrite(null);
    }

    /**
     * @test
     * @expectedException \System\IO\PathTooLongException
    */
    public function OpenWrite_ThrowsExceptionWhenPathIsLong() {

        # Arrange:
        $path = str_repeat('dotnetonphp', 30);

        # Act:
        Files::openWrite($path);
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function OpenWrite_ThrowsExceptionWhenFileNotFound() {

        # Arrange:
        # Act:
        Files::openWrite('/tmp/file_not_found.ow');
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function OpenWrite_ThrowsExceptionWhenPathIsEmpty() {

        # Arrange:
        # Act:
        Files::openWrite("");
    }

    /**
     * @test
    */
    public function OpenWrite_CanOpenFileInWriteMode() {

        # Arrange:
        $file = $this->generateFile();

        # Act:
        $fs = Files::openWrite($file);

        # Assert:
        $this->assertTrue($fs->canWrite());
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function ReadAllBytes_ThrowsExceptionWhenPathIsNull() {

        # Arrange:
        # Act:
        Files::readAllBytes(null);
    }

    /**
     * @test
     * @expectedException \System\IO\PathTooLongException
    */
    public function ReadAllBytes_ThrowsExceptionPathIsLong() {

        # Arrange:
        $path = str_repeat('dotnetonphp', 30);

        # Act:
        Files::readAllBytes($path);
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function ReadAllBytes_ThrowsExceptionWhenFileNotFound() {

        # Arrange:
        # Act:
        Files::readAllBytes('/tmp/file_not_found.tmp');
    }

    /**
     * @test
    */
    public function ReadAllBytes_CanReadFile() {

        # Arrange:
        $file = $this->generateFile();

        # Act:
        $content = Files::readAllBytes($file);

        # Assert:
        $this->assertEquals('dotnetonphp', implode($content));
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function ReadAllLines_ThrowsExceptionWhenPathIsNull() {

        # Arrange:
        # Act:
        Files::readAllLines(null);
    }

    /**
     * @test
     * @expectedException \System\IO\PathTooLongException
    */
    public function ReadAllLines_ThrowsExceptionPathIsLong() {

        # Arrange:
        $path = str_repeat('dotnetonphp', 30);

        # Act:
        Files::readAllLines($path);
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function ReadAllLines_ThrowsExceptionWhenFileNotFound() {

        # Arrange:
        # Act:
        Files::readAllLines('/tmp/file_not_found.tmp');
    }

    /**
     * @test
    */
    public function ReadAllLines_CanReadFile() {

        # Arrange:
        $file = $this->generateFileWithBreakLine();

        # Act:
        $content = Files::readAllLines($file);

        # Assert:
        $this->assertEquals(10, sizeof($content));
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function ReadAllText_ThrowsExceptionWhenPathIsNull() {

        # Arrange:
        # Act:
        Files::readAllText(null);
    }

    /**
     * @test
     * @expectedException \System\IO\PathTooLongException
    */
    public function ReadAllText_ThrowsExceptionPathIsLong() {

        # Arrange:
        $path = str_repeat('dotnetonphp', 30);

        # Act:
        Files::readAllText($path);
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function ReadAllText_ThrowsExceptionWhenFileNotFound() {

        # Arrange:
        # Act:
        Files::readAllText('/tmp/file_not_found.tmp');
    }

    /**
     * @test
    */
    public function ReadAllText_CanReadFile() {

        # Arrange:
        $file = $this->generateFile();

        # Act:
        $content = Files::readAllText($file);

        # Assert:
        $this->assertEquals('dotnetonphp', $content);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function Replace_ThrowsExceptionWhenDestinationIsNull() {

        # Arrange:
        $source = $this->generateFile();

        # Act:
        Files::replace($source, null, '/tmp/file.a');
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function Replace_ThrowsExceptionWhenSourceNotFound() {

        # Arrange:
        $source = $this->generateName();

        # Act:
        Files::replace($source, '/tmp/file.ab', '/tmp/file.a');
    }

    /**
     * @test
    */
    public function Replace_CanReplaceAndGenerateBackup() {

        # Arrange:
        $source = $this->generateFile();
        $destination = $this->generateFile();
        $backup = $this->generateName();

        # Act:
        Files::replace($source, $destination, $backup);

        # Assert:
        $this->assertFileNotExists($source);
        $this->assertFileExists($destination);
        $this->assertFileExists($backup);
    }


    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function SetLastAccessTime_ThrowsExceptionWhenFileNotFound() {

        # Arrange:
        $path = $this->generateName();

        # Act:
        Files::setLastAccessTime($path, DateTime::now());
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function SetLastAccessTime_ThrowsExceptionWhenPathIsEmpty() {

        # Arrange:
        $path = "";

        # Act:
        Files::setLastAccessTime($path, DateTime::now());
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function SetLastAccessTime_ThrowsExceptionWhenPathIsNull() {

        # Arrange:
        $path = null;

        # Act:
        Files::setLastAccessTime($path, DateTime::now());
    }

    /**
     * @test
     * @expectedException \System\IO\PathTooLongException
    */
    public function SetLastAccessTime_ThrowsExceptionWhenPathTooLong() {

        # Arrange:
        $path = str_repeat('dotnetonphp', 25);

        # Act:
        Files::setLastAccessTime($path, DateTime::now());
    }

    /**
     * @test
    */
    public function SetLastAccessTime_CanModifyLastAccessTime() {

        # Arrange:
        $file = $this->generateFile();
        $dateTime = DateTime::now(2000, 10, 10, 1, 0, 0);

        # Act:
        Files::setLastAccessTime($file, $dateTime);


        # Assert:
        $stat = stat($file);
        $this->assertEquals($stat['atime'], $dateTime->toBinary());
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function SetLastWriteTime_ThrowsExceptionWhenFileNotFound() {

        # Arrange:
        $path = $this->generateName();

        # Act:
        Files::setLastWriteTime($path, DateTime::now());
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function SetLastWriteTime_ThrowsExceptionWhenPathIsEmpty() {

        # Arrange:
        $path = "";

        # Act:
        Files::setLastWriteTime($path, DateTime::now());
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function SetLastWriteTime_ThrowsExceptionWhenPathIsNull() {

        # Arrange:
        $path = null;

        # Act:
        Files::setLastWriteTime($path, DateTime::now());
    }

    /**
     * @test
     * @expectedException \System\IO\PathTooLongException
    */
    public function SetLastWriteTime_ThrowsExceptionWhenPathTooLong() {

        # Arrange:
        $path = str_repeat('dotnetonphp', 25);

        # Act:
        Files::setLastWriteTime($path, DateTime::now());
    }

    /**
     * @test
    */
    public function SetLastWriteTime_CanModifyLastWriteTime() {

        # Arrange:
        $file = $this->generateFile();
        $dateTime = DateTime::now(2000, 10, 10, 1, 0, 0);

        # Act:
        Files::setLastWriteTime($file, $dateTime);


        # Assert:
        $stat = stat($file);
        $this->assertEquals($stat['mtime'], $dateTime->toBinary());
    }


    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function WriteAllBytes_ThrowsExceptionWhenFileIsEmpty() {

        # Arrange:
        $path = "";

        # Act:
        Files::writeAllBytes($path, array('dotnetonphp'));
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function WriteAllBytes_ThrowsExceptionWhenFileIsNull() {

        # Arrange:
        # Act:
        Files::writeAllBytes(null, array('dotnetonphp'));
    }

    /**
     * @test
     * @expectedException \System\IO\PathTooLongException
    */
    public function WriteAllBytes_ThrowsExceptionWhenFileHasLongName() {

        # Arrange:
        $path = str_repeat('dotnetonphp', 25);

        # Act:
        Files::writeAllBytes($path, array('dotnetonphp'));
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function WriteAllBytes_ThrowsExceptionWhenFileNotFound() {

        # Arrange:
        $path = '/tmp/file_not_found.w';

        # Act:
        Files::writeAllBytes($path, array('dotnetonphp'));
    }


    /**
     * @test
    */
    public function WriteAllBytes_CanWriteAllBytesInFile() {

        # Arrange:
        $path = $this->generateFile();

        # Act:
        Files::writeAllBytes($path, array('.NetOnPhp'));

        # Assert:
        $this->assertEquals('.NetOnPhp', implode(Files::readAllBytes($path)));
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function WriteAllLines_ThrowsExceptionWhenFileIsEmpty() {

        # Arrange:
        $path = "";

        # Act:
        Files::writeAllLines($path, array('dotnetonphp'));
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function WriteAllLines_ThrowsExceptionWhenFileIsNull() {

        # Arrange:
        # Act:
        Files::writeAllLines(null, array('dotnetonphp'));
    }

    /**
     * @test
     * @expectedException \System\IO\PathTooLongException
    */
    public function WriteAllLines_ThrowsExceptionWhenFileHasLongName() {

        # Arrange:
        $path = str_repeat('dotnetonphp', 25);

        # Act:
        Files::writeAllLines($path, array('dotnetonphp'));
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function WriteAllLines_ThrowsExceptionWhenFileNotFound() {

        # Arrange:
        $path = '/tmp/file_not_found.w';

        # Act:
        Files::writeAllLines($path, array('dotnetonphp'));
    }


    /**
     * @test
    */
    public function WriteAllLines_CanWriteAllLinesInFile() {

        # Arrange:
        $path = $this->generateFile();

        # Act:
        Files::writeAllLines($path, array('.NetOnPhp'));

        # Assert:
        $this->assertEquals('.NetOnPhp', implode(Files::readAllBytes($path)));
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function WriteAllText_ThrowsExceptionWhenFileIsEmpty() {

        # Arrange:
        $path = "";

        # Act:
        Files::writeAllText($path, array('dotnetonphp'));
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function WriteAllText_ThrowsExceptionWhenFileIsNull() {

        # Arrange:
        # Act:
        Files::writeAllText(null, array('dotnetonphp'));
    }

    /**
     * @test
     * @expectedException \System\IO\PathTooLongException
    */
    public function WriteAllText_ThrowsExceptionWhenFileHasLongName() {

        # Arrange:
        $path = str_repeat('dotnetonphp', 25);

        # Act:
        Files::writeAllText($path, array('dotnetonphp'));
    }

    /**
     * @test
     * @expectedException \System\IO\FileNotFoundException
    */
    public function WriteAllText_ThrowsExceptionWhenFileNotFound() {

        # Arrange:
        $path = '/tmp/file_not_found.w';

        # Act:
        Files::writeAllText($path, array('dotnetonphp'));
    }


    /**
     * @test
    */
    public function WriteAllText_CanWriteTextInFile() {

        # Arrange:
        $path = $this->generateFile();

        # Act:
        Files::writeAllText($path, array('.NetOnPhp'));

        # Assert:
        $this->assertEquals('.NetOnPhp', implode(Files::readAllBytes($path)));
    }
}
