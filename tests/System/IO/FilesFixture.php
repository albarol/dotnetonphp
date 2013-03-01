<?php

require_once dirname(__FILE__) . '/../../../src/Autoloader.php';

use \System\IO\Files as Files;
use \System\IO\FileStream as FileStream;
use \System\IO\StreamReader as StreamReader;

class FilesFixture extends PHPUnit_Framework_TestCase {

    protected $files;

    public function setUp() {
        $this->files = array(
            'fromFile' => dirname(__FILE__) . "/../../resources/system.io.fromFile.txt",
            'toFile' => dirname(__FILE__) . "/../../resources/system.io.File.txt",
            'streamWriter' => dirname(__FILE__) . "/../../resources/system.io.StreamWriter.txt"
        );
    }

    public function tearDown() {
        foreach($this->files as $k => $v) {
            if(file_exists($v) && $k != "streamWriter")
                unlink($v);
        }
    }

    public function test_AppendAllText_ThrowsExceptionWhenPathIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        Files::appendAllText(null, "dotnetonphp");
    }

    public function test_AppendAllText_ThrowsExceptionWhenPathIsEmpty() {
        $this->setExpectedException("\\System\\ArgumentException");
        Files::appendAllText("", "dotnetonphp");
    }

    public function test_AppendAllText_ThrowsExceptionWhenPathIsLong() {
        $this->setExpectedException("\\System\\IO\\PathTooLongException");
        $filename = "aokdfaoksdfoaksdfoaksodfkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaoskoasdfasdfadf";
        Files::appendAllText($filename, "dotnetonphp");
    }

    public function test_AppendAllText_CanAppendText() {
        Files::appendAllText($this->files['fromFile'], "dotnetonphp");
        $this->assertFileExists($this->files['fromFile']);
    }

    public function test_AppendText_CanAppendTextInFile() {
        $sw = Files::appendText($this->files['fromFile']);
        $sw->write("dotnetonphp");
        $sw->dispose();
        $this->fileExists($this->files['fromFile']);
    }

    public function test_Copy_ThrowsExceptionWhenFileNotFound() {
        $this->setExpectedException("\\System\\IO\\FileNotFoundException");
        Files::copy("../../resources/dotnetonphp", "");
    }

    public function test_Copy_ThrowsExceptionWhenFileExists() {
        $this->setExpectedException("\\System\\IO\\IOException");
        Files::copy($this->files['streamWriter'], $this->files['streamWriter']);
    }

    public function test_Copy_CanCopyFile() {
        Files::copy($this->files['streamWriter'], $this->files['toFile']);
        $this->fileExists($this->files['toFile']);
    }

    public function test_Delete_ThrowsExceptionWhenFileNotFound() {
        $this->setExpectedException("\\System\\IO\\FileNotFoundException");
        Files::delete("../file_not_found.txt");
    }

    public function test_Delete_CanDeleteFile() {
        Files::copy($this->files['streamWriter'], $this->files['toFile']);
        Files::delete($this->files['toFile']);
        $this->assertFalse(file_exists($this->files['toFile']));
    }

    public function test_Exists_ShouldReturnTrueIfFileExists() {
        $exists = Files::exists($this->files['streamWriter']);
        $this->assertTrue($exists);
    }

    public function test_Exists_ShouldReturnFalseIfFileExists() {
        $exists = Files::exists($this->files['fromFile']);
        $this->assertFalse($exists);
    }

    public function test_GetCreationTime_CanGetCreationTime() {
        $creationTime = Files::getCreationTime($this->files['streamWriter']);
        $this->assertGreaterThan(1999, $creationTime->year());
    }

    public function test_GetLastAccessTime_CanGetLastAccessTime() {
        $lastAccessTime = Files::getLastAccessTime($this->files['streamWriter']);
        $this->assertGreaterThan(1999, $lastAccessTime->year());
    }

    public function test_GetLastWrite_CanGetLastWriteTime() {
        $lastAccessTime = Files::getLastWriteTime($this->files['streamWriter']);
        $this->assertGreaterThan(1999, $lastAccessTime->year());
    }

    public function test_Move_ThrowExceptionWhenDestinationExists() {
        $this->setExpectedException("\\System\\IO\\IOException");
        Files::move($this->files['streamWriter'], $this->files['streamWriter']);
    }

    public function test_Move_ThrowsExceptionWhenSourceIsNull(){
        $this->setExpectedException("\\System\\ArgumentNullException");
        Files::move(null, $this->files['streamWriter']);
    }

    public function test_Move_ThrowsExceptionWhenDestinationIsNull(){
        $this->setExpectedException("\\System\\ArgumentNullException");
        Files::move($this->files['streamWriter'], null);
    }

    public function test_Move_ThrowsExceptionWhenFileNotFound() {
        $this->setExpectedException("\\System\\IO\\FileNotFoundException");
        Files::move($this->files['streamWriter']."t", $this->files['streamWriter']);
    }

    public function test_Move_CanMoveFile() {
        $destination = dirname(__FILE__) . '/../../resources/system.io.FilesMove.txt';
        $copyFile = dirname(__FILE__) . '/../../resources/system.io.FilesMove2.txt';
        Files::copy($this->files['streamWriter'], $copyFile);
        Files::move($copyFile, $destination);
        $this->fileExists($destination);
        Files::delete($destination);
    }

    public function test_Open_ThrowsExceptionWhenPathIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        Files::open(null);
    }

    public function test_Open_ThrowsExceptionWhenPathIsLong() {
        $this->setExpectedException("\\System\\IO\\PathTooLongException");
        $path = "aokdfaoksdfoaksdfoaksodfkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaoskoasdfasdfadf";
        Files::open($path);
    }

    public function test_Open_ThrowsExceptionWhenFileNotFound() {
        $this->setExpectedException("\\System\\IO\\FileNotFoundException");
        Files::open($this->files['toFile']);
    }

    public function test_Open_CanOpenFile() {
        $file = Files::open($this->files['streamWriter']);
        $this->assertTrue($file instanceof FileStream);
    }

    public function test_OpenRead_ThrowsExceptionWhenPathIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        Files::openRead(null);
    }

    public function test_OpenRead_ThrowsExceptionWhenPathIsLong() {
        $this->setExpectedException("\\System\\IO\\PathTooLongException");
        $path = "aokdfaoksdfoaksdfoaksodfkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaoskoasdfasdfadf";
        Files::openRead($path);
    }

    public function test_OpenRead_ThrowsExceptionWhenFileNotFound() {
        $this->setExpectedException("\\System\\IO\\FileNotFoundException");
        Files::openRead($this->files['toFile']);
    }

    public function test_OpenRead_CanOpenFileInReadMode() {
        $file = Files::openRead($this->files['streamWriter']);
        $this->assertFalse($file->canWrite());
    }

    public function test_OpenText_ThrowsExceptionWhenPathIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        Files::openText(null);
    }

    public function test_OpenText_ThrowsExceptionWhenPathIsLong() {
        $this->setExpectedException("\\System\\IO\\PathTooLongException");
        $path = "aokdfaoksdfoaksdfoaksodfkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaoskoasdfasdfadf";
        Files::openText($path);
    }

    public function test_OpenText_ThrowsExceptionWhenFileNotFound() {
        $this->setExpectedException("\\System\\IO\\FileNotFoundException");
        Files::openText($this->files['toFile']);
    }

    public function test_OpenText_CanOpenFileInReadMode() {
        $stream = Files::openText($this->files['streamWriter']);
        $this->assertTrue($stream instanceof StreamReader);
    }

    public function test_OpenWrite_ThrowsExceptionWhenPathIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        Files::openWrite(null);
    }

    public function test_OpenWrite_ThrowsExceptionWhenPathIsLong() {
        $this->setExpectedException("\\System\\IO\\PathTooLongException");
        $path = "aokdfaoksdfoaksdfoaksodfkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaoskoasdfasdfadf";
        Files::openWrite($path);
    }

    public function test_OpenWrite_ThrowsExceptionWhenFileNotFound() {
        $this->setExpectedException("\\System\\IO\\FileNotFoundException");
        Files::openWrite($this->files['toFile']);
    }

    public function test_OpenWrite_CanOpenFileInWriteMode() {
        $file = Files::openWrite($this->files['streamWriter']);
        $this->assertTrue($file->canWrite());
    }

    public function test_ReadAllBytes_ThrowsExceptionWhenPathIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        Files::readAllBytes(null);
    }

    public function test_ReadAllBytes_ThrowsExceptionPathIsLong() {
        $this->setExpectedException("\\System\\IO\\PathTooLongException");
        $path = "aokdfaoksdfoaksdfoaksodasdfadffkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaoskoasdfasdfadf";
        Files::readAllBytes($path);
    }

    public function test_ReadAllBytes_ThrowsExceptionWhenFileNotFound() {
        $this->setExpectedException("\\System\\IO\\FileNotFoundException");
        Files::readAllBytes($this->files['toFile']);
    }

    public function test_ReadAllBytes_CanReadFile() {
        $bytes = Files::readAllBytes($this->files['streamWriter']);
        $this->assertGreaterThan(0, sizeof($bytes));
    }

    public function test_ReadAllLines_ThrowsExceptionWhenPathIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        Files::readAllLines(null);
    }

    public function test_ReadAllLines_ThrowsExceptionPathIsLong() {
        $this->setExpectedException("\\System\\IO\\PathTooLongException");
        $path = "aokdfaoksdfoaksdfoaksodasdfadffkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaoskoasdfasdfadf";
        Files::readAllLines($path);
    }

    public function test_ReadAllLines_ThrowsExceptionWhenFileNotFound() {
        $this->setExpectedException("\\System\\IO\\FileNotFoundException");
        Files::readAllLines($this->files['toFile']);
    }

    public function test_ReadAllLines_CanReadFile() {
        $lines = Files::readAllLines($this->files['streamWriter']);
        $this->assertGreaterThan(0, sizeof($lines));
    }
}
?>
