<?php


use \System\IO\Files as Files;
use \System\IO\FileMode as FileMode;
use \System\IO\FileAccess as FileAccess;
use \System\IO\FileStream as FileStream;
use \System\IO\StreamReader as StreamReader;

class FilesTestCase extends PHPUnit_Framework_TestCase {

    private function generateName()
    {
        return '/tmp/'.md5(rand(1, 20).rand(22, 45).rand(51, 100)).'.txt';
    }

    private function generateFile()
    {
        $file_name = $this->generateName();
        touch($file_name);
        return $file_name;
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
        $filename = "/tmp/faoksdfoaksdfoaksodfkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaoskoasdfasdfadf";

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
        $sw->write("dotnetonphp");
        $sw->dispose();

        # Assert:
        $content = Files::readAllLines($filename);
        $this->assertEquals('dotnetonphp', implode($content));
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

    // /**
    //  * @test
    // */
    // public function OpenText_ThrowsExceptionWhenFileNotFound() {
    //     $this->setExpectedException("\\System\\IO\\FileNotFoundException");
    //     Files::openText($this->files['toFile']);
    // }

    // /**
    //  * @test
    // */
    // public function OpenText_CanOpenFileInReadMode() {
    //     $stream = Files::openText($this->files['streamWriter']);
    //     $this->assertTrue($stream instanceof StreamReader);
    // }

    // /**
    //  * @test
    // */
    // public function OpenWrite_ThrowsExceptionWhenPathIsNull() {
    //     $this->setExpectedException("\\System\\ArgumentNullException");
    //     Files::openWrite(null);
    // }

    // /**
    //  * @test
    // */
    // public function OpenWrite_ThrowsExceptionWhenPathIsLong() {
    //     $this->setExpectedException("\\System\\IO\\PathTooLongException");
    //     $path = "aokdfaoksdfoaksdfoaksodfkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaoskoasdfasdfadf";
    //     Files::openWrite($path);
    // }

    // /**
    //  * @test
    // */
    // public function OpenWrite_ThrowsExceptionWhenFileNotFound() {
    //     $this->setExpectedException("\\System\\IO\\FileNotFoundException");
    //     Files::openWrite($this->files['toFile']);
    // }

    // /**
    //  * @test
    // */
    // public function OpenWrite_CanOpenFileInWriteMode() {
    //     $file = Files::openWrite($this->files['streamWriter']);
    //     $this->assertTrue($file->canWrite());
    // }

    // /**
    //  * @test
    // */
    // public function ReadAllBytes_ThrowsExceptionWhenPathIsNull() {
    //     $this->setExpectedException("\\System\\ArgumentNullException");
    //     Files::readAllBytes(null);
    // }

    // /**
    //  * @test
    // */
    // public function ReadAllBytes_ThrowsExceptionPathIsLong() {
    //     $this->setExpectedException("\\System\\IO\\PathTooLongException");
    //     $path = "aokdfaoksdfoaksdfoaksodasdfadffkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaoskoasdfasdfadf";
    //     Files::readAllBytes($path);
    // }

    // /**
    //  * @test
    // */
    // public function ReadAllBytes_ThrowsExceptionWhenFileNotFound() {
    //     $this->setExpectedException("\\System\\IO\\FileNotFoundException");
    //     Files::readAllBytes($this->files['toFile']);
    // }

    // /**
    //  * @test
    // */
    // public function ReadAllBytes_CanReadFile() {
    //     $bytes = Files::readAllBytes($this->files['streamWriter']);
    //     $this->assertGreaterThan(0, sizeof($bytes));
    // }

    // /**
    //  * @test
    // */
    // public function ReadAllLines_ThrowsExceptionWhenPathIsNull() {
    //     $this->setExpectedException("\\System\\ArgumentNullException");
    //     Files::readAllLines(null);
    // }

    // /**
    //  * @test
    // */
    // public function ReadAllLines_ThrowsExceptionPathIsLong() {
    //     $this->setExpectedException("\\System\\IO\\PathTooLongException");
    //     $path = "aokdfaoksdfoaksdfoaksodasdfadffkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaoskoasdfasdfadf";
    //     Files::readAllLines($path);
    // }

    // /**
    //  * @test
    // */
    // public function ReadAllLines_ThrowsExceptionWhenFileNotFound() {
    //     $this->setExpectedException("\\System\\IO\\FileNotFoundException");
    //     Files::readAllLines($this->files['toFile']);
    // }

    // /**
    //  * @test
    // */
    // public function ReadAllLines_CanReadFile() {
    //     $lines = Files::readAllLines($this->files['streamWriter']);
    //     $this->assertGreaterThan(0, sizeof($lines));
    // }
}
