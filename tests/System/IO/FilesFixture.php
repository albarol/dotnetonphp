<?php


use \System\IO\Files as Files;
use \System\IO\FileStream as FileStream;
use \System\IO\StreamReader as StreamReader;

class FilesFixture extends PHPUnit_Framework_TestCase {

    private function generateName()
    {
        return '/tmp/'.md5(rand(1, 50).rand(51, 100)).'.txt';
    }

    private function generateFile()
    {
        $file_name = $this->generateName();
        touch($file_name);
        return $file_name;    
    }

    // public function setUp() {
    //     $this->files = array(
    //         'fromFile' => dirname(__FILE__) . "/../../resources/system.io.fromFile.txt",
    //         'toFile' => dirname(__FILE__) . "/../../resources/system.io.File.txt",
    //         'streamWriter' => dirname(__FILE__) . "/../../resources/system.io.StreamWriter.txt"
    //     );
    // }

    // public function tearDown() {
    //     foreach($this->files as $k => $v) {
    //         if(file_exists($v) && $k != "streamWriter")
    //             unlink($v);
    //     }
    // }

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
        $fromFile = $this->generateFile();
        $toFile = $this->generateName();

        # Act:
        Files::copy($fromFile, $toFile);
    }

    // /**
    //  * @test
    // */
    // public function Copy_ThrowsExceptionWhenFileExists() {
    //     $this->setExpectedException("\\System\\IO\\IOException");
    //     Files::copy($this->files['streamWriter'], $this->files['streamWriter']);
    // }

    // /**
    //  * @test
    // */
    // public function Copy_CanCopyFile() {
    //     Files::copy($this->files['streamWriter'], $this->files['toFile']);
    //     $this->fileExists($this->files['toFile']);
    // }

    // /**
    //  * @test
    // */
    // public function Delete_ThrowsExceptionWhenFileNotFound() {
    //     $this->setExpectedException("\\System\\IO\\FileNotFoundException");
    //     Files::delete("../file_not_found.txt");
    // }

    // /**
    //  * @test
    // */
    // public function Delete_CanDeleteFile() {
    //     Files::copy($this->files['streamWriter'], $this->files['toFile']);
    //     Files::delete($this->files['toFile']);
    //     $this->assertFalse(file_exists($this->files['toFile']));
    // }

    // /**
    //  * @test
    // */
    // public function Exists_ShouldReturnTrueIfFileExists() {
    //     $exists = Files::exists($this->files['streamWriter']);
    //     $this->assertTrue($exists);
    // }

    // /**
    //  * @test
    // */
    // public function Exists_ShouldReturnFalseIfFileExists() {
    //     $exists = Files::exists($this->files['fromFile']);
    //     $this->assertFalse($exists);
    // }

    // /**
    //  * @test
    // */
    // public function GetCreationTime_CanGetCreationTime() {
    //     $creationTime = Files::getCreationTime($this->files['streamWriter']);
    //     $this->assertGreaterThan(1999, $creationTime->year());
    // }

    // /**
    //  * @test
    // */
    // public function GetLastAccessTime_CanGetLastAccessTime() {
    //     $lastAccessTime = Files::getLastAccessTime($this->files['streamWriter']);
    //     $this->assertGreaterThan(1999, $lastAccessTime->year());
    // }

    // /**
    //  * @test
    // */
    // public function GetLastWrite_CanGetLastWriteTime() {
    //     $lastAccessTime = Files::getLastWriteTime($this->files['streamWriter']);
    //     $this->assertGreaterThan(1999, $lastAccessTime->year());
    // }

    // /**
    //  * @test
    // */
    // public function Move_ThrowExceptionWhenDestinationExists() {
    //     $this->setExpectedException("\\System\\IO\\IOException");
    //     Files::move($this->files['streamWriter'], $this->files['streamWriter']);
    // }

    // /**
    //  * @test
    // */
    // public function Move_ThrowsExceptionWhenSourceIsNull(){
    //     $this->setExpectedException("\\System\\ArgumentNullException");
    //     Files::move(null, $this->files['streamWriter']);
    // }

    // /**
    //  * @test
    // */
    // public function Move_ThrowsExceptionWhenDestinationIsNull(){
    //     $this->setExpectedException("\\System\\ArgumentNullException");
    //     Files::move($this->files['streamWriter'], null);
    // }

    // /**
    //  * @test
    // */
    // public function Move_ThrowsExceptionWhenFileNotFound() {
    //     $this->setExpectedException("\\System\\IO\\FileNotFoundException");
    //     Files::move($this->files['streamWriter']."t", $this->files['streamWriter']);
    // }

    // /**
    //  * @test
    // */
    // public function Move_CanMoveFile() {
    //     $destination = dirname(__FILE__) . '/../../resources/system.io.FilesMove.txt';
    //     $copyFile = dirname(__FILE__) . '/../../resources/system.io.FilesMove2.txt';
    //     Files::copy($this->files['streamWriter'], $copyFile);
    //     Files::move($copyFile, $destination);
    //     $this->fileExists($destination);
    //     Files::delete($destination);
    // }

    // /**
    //  * @test
    // */
    // public function Open_ThrowsExceptionWhenPathIsNull() {
    //     $this->setExpectedException("\\System\\ArgumentNullException");
    //     Files::open(null);
    // }

    // /**
    //  * @test
    // */
    // public function Open_ThrowsExceptionWhenPathIsLong() {
    //     $this->setExpectedException("\\System\\IO\\PathTooLongException");
    //     $path = "aokdfaoksdfoaksdfoaksodfkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaoskoasdfasdfadf";
    //     Files::open($path);
    // }

    // /**
    //  * @test
    // */
    // public function Open_ThrowsExceptionWhenFileNotFound() {
    //     $this->setExpectedException("\\System\\IO\\FileNotFoundException");
    //     Files::open($this->files['toFile']);
    // }

    // /**
    //  * @test
    // */
    // public function Open_CanOpenFile() {
    //     $file = Files::open($this->files['streamWriter']);
    //     $this->assertTrue($file instanceof FileStream);
    // }

    // /**
    //  * @test
    // */
    // public function OpenRead_ThrowsExceptionWhenPathIsNull() {
    //     $this->setExpectedException("\\System\\ArgumentNullException");
    //     Files::openRead(null);
    // }

    // /**
    //  * @test
    // */
    // public function OpenRead_ThrowsExceptionWhenPathIsLong() {
    //     $this->setExpectedException("\\System\\IO\\PathTooLongException");
    //     $path = "aokdfaoksdfoaksdfoaksodfkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaoskoasdfasdfadf";
    //     Files::openRead($path);
    // }

    // /**
    //  * @test
    // */
    // public function OpenRead_ThrowsExceptionWhenFileNotFound() {
    //     $this->setExpectedException("\\System\\IO\\FileNotFoundException");
    //     Files::openRead($this->files['toFile']);
    // }

    // /**
    //  * @test
    // */
    // public function OpenRead_CanOpenFileInReadMode() {
    //     $file = Files::openRead($this->files['streamWriter']);
    //     $this->assertFalse($file->canWrite());
    // }

    // /**
    //  * @test
    // */
    // public function OpenText_ThrowsExceptionWhenPathIsNull() {
    //     $this->setExpectedException("\\System\\ArgumentNullException");
    //     Files::openText(null);
    // }

    // /**
    //  * @test
    // */
    // public function OpenText_ThrowsExceptionWhenPathIsLong() {
    //     $this->setExpectedException("\\System\\IO\\PathTooLongException");
    //     $path = "aokdfaoksdfoaksdfoaksodfkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaoskoasdfasdfadf";
    //     Files::openText($path);
    // }

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
