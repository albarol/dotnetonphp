<?php

require_once dirname(__FILE__) . '/../../../system/io/FileInfo.php';

use \System\IO\FileInfo as FileInfo;
use \System\IO\FileAttributes as FileAttributes;
use \System\IO\StreamWriter as StreamWriter;
use \System\IO\FileStream as FileStream;
use \System\IO\StreamReader as StreamReader;

class FileInfoFixture extends PHPUnit_Framework_TestCase {

    protected $fileInfo;

    protected function setUp() {
        $this->fileInfo = dirname(__FILE__) . "/../../resources/system.io.fileInfo.txt";
    }

    protected function tearDown() {
        $files = array(
            dirname(__FILE__) . "/../../resources/system.io.fileInfo2.txt",
            dirname(__FILE__) . "/../../resources/system.io.fileInfo3.txt",
            dirname(__FILE__) . "/../../resources/system.io.fileInfo.txt.bak"
        );

        foreach($files as $file) {
            if(file_exists($file))
                unlink($file);
        }
    }

    public function test_Constructor_ThrowsExceptionWhenFileNameIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        new FileInfo(null);
    }

    public function test_Constructor_ThrowsExceptionWhenArgumentIsInvalid() {
        $this->setExpectedException("\\System\\ArgumentException");
        new FileInfo("");
    }

    public function test_Constructor_ThrowsExceptionWhenPathIsTooLong() {
        $this->setExpectedException("\\System\\IO\\PathTooLongException");
        new FileInfo("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
    }

    public function test_Constructor_ThrowsExceptionWhenFileNotFound() {
        $this->setExpectedException("\\System\\IO\\FileNotFoundException");
        new FileInfo("../../resources/system.io.filoinfo2.txt");
    }

    public function test_Constructor_CanCreateFileInfoFromAnyFile() {
        $fileInfo = new FileInfo($this->fileInfo);
        $this->assertEquals($fileInfo->name(), "system.io.fileInfo.txt");
    }

    public function test_Attributes_CanGetAttributesFromFile() {
        $fileInfo = new FileInfo($this->fileInfo);
        $this->assertEquals(FileAttributes::Archive, $fileInfo->attributes());
    }

    public function test_CreationTime_GetWhenFileWasCreated() {
        $fileInfo = new FileInfo($this->fileInfo);
        $this->assertTrue($fileInfo->creationTime() != null);
    }

    public function test_CreationTimeUTC_GetWhenFileWasCreateInUTCFormat() {
        $fileInfo = new FileInfo($this->fileInfo);
        $this->assertTrue($fileInfo->creationTimeUtc() != null);
    }

    public function test_Exists_GetIfFileExists() {
        $fileInfo = new FileInfo($this->fileInfo);
        $this->assertTrue($fileInfo->exists());
    }

    public function test_Extension_CanGetExtension() {
        $fileInfo = new FileInfo($this->fileInfo);
        $this->assertEquals("txt", $fileInfo->extension());
    }

    public function test_FullName_CanGetFullName() {
        $fileInfo = new FileInfo($this->fileInfo);
        $this->assertTrue(strlen($fileInfo->fullName()) > 10);
    }

    public function test_LastAccess_CanGetLastAccess() {
        $fileInfo = new FileInfo($this->fileInfo);
        $this->assertTrue($fileInfo->lastAccessTime() != null);
    }

    public function test_LastAccessUtc_CanGetLastAccessInUtcFormat() {
        $fileInfo = new FileInfo($this->fileInfo);
        $this->assertTrue($fileInfo->lastAccessTimeUtc() != null);
    }

    public function test_LastWrite_CanGetLastWrite() {
        $fileInfo = new FileInfo($this->fileInfo);
        $this->assertTrue($fileInfo->lastWriteTime() != null);
    }

    public function test_LastWriteUtc_CanGetLastWriteInUtcFormat() {
        $fileInfo = new FileInfo($this->fileInfo);
        $this->assertTrue($fileInfo->lastWriteTimeUtc() != null);
    }

    public function test_Name_CanGetNameOfFile() {
        $fileInfo = new FileInfo($this->fileInfo);
        $this->assertEquals("system.io.fileInfo.txt", $fileInfo->name());
    }

    public function test_Directory_CanGetDirectoryInfo() {
        $fileInfo = new FileInfo($this->fileInfo);
        $directory = $fileInfo->directory();
        $this->assertTrue($directory != null);
    }

    public function test_DirectoryName_CanGetNameOfParentDirectory() {
        $fileInfo = new FileInfo($this->fileInfo);
        $this->assertTrue(strlen($fileInfo->directoryName()) > 0);
    }

    public function test_IsReadOnly_CanGetInformationIfFileIsReadOnly() {
        $fileInfo = new FileInfo($this->fileInfo);
        $this->assertFalse($fileInfo->isReadOnly());
    }

    public function test_Length_CanGetLengthOfFile() {
        $fileInfo = new FileInfo($this->fileInfo);
        $this->assertEquals(17, $fileInfo->length());
    }

    public function test_AppendText_WhenAppendTextShouldReturnStreamWriterInstance() {
        $fileInfo = new FileInfo($this->fileInfo);
        $writer = $fileInfo->appendText();
        $this->assertTrue($writer instanceof StreamWriter);
    }

    public function test_CopyTo_CanCopyToAnotherFile() {
        $fileInfo = new FileInfo($this->fileInfo);
        $newFile = $fileInfo->copyTo("system.io.fileInfo2.txt");
        $this->assertTrue(file_exists($newFile->fullName()));
    }

    public function test_CopyTo_OverwriteIfFileExists() {
        $fileInfo = new FileInfo($this->fileInfo);
        $newFile = $fileInfo->copyTo("system.io.fileInfo.txt", true);
        $this->assertTrue(file_exists($newFile->fullName()));
    }

    public function test_Create_CanCreateFileStream() {
        $fileInfo = new FileInfo($this->fileInfo);
        $stream = $fileInfo->create();
        $this->assertTrue($stream instanceof FileStream);
    }

    public function test_CreateText_CanCreateTextFile() {
        $fileInfo = new FileInfo($this->fileInfo);
        $stream = $fileInfo->createText();
        $this->assertTrue($stream instanceof StreamWriter);
    }

    public function test_Delete_ShouldDeleteAnyFile() {
        $fileInfo = new FileInfo($this->fileInfo);
        $newFile = $fileInfo->copyTo("system.io.fileInfo2.txt", true);
        $newFile->delete();
        $this->assertFalse(file_exists($newFile->fullName()));
    }

    public function test_MoveTo_ThrowsExceptionWhenFileExists() {
        $this->setExpectedException("\\System\\IO\\IOException");
        $fileInfo = new FileInfo($this->fileInfo);
        $newFile = $fileInfo->copyTo("system.io.fileInfo2.txt", true);
        $newFile->moveTo("system.io.fileInfo.txt");
    }


    public function test_MoveTo_CanMoveFile() {
        $fileInfo = new FileInfo($this->fileInfo);
        $newFile = $fileInfo->copyTo("system.io.fileInfo2.txt", true);
        $newFile->moveTo("system.io.fileInfo3.txt");
        $this->assertTrue(file_exists($newFile->directoryName()."/system.io.fileInfo3.txt"));
    }

    public function test_Open_CanGetFileStream() {
        $fileInfo = new FileInfo($this->fileInfo);
        $stream = $fileInfo->open();
        $this->assertTrue($stream instanceof FileStream);
    }

    public function test_OpenRead_CanGetFileStream() {
        $fileInfo = new FileInfo($this->fileInfo);
        $stream = $fileInfo->open();
        $this->assertTrue($stream instanceof FileStream);
    }

    public function test_OpenText_CanGetStreamReader() {
        $fileInfo = new FileInfo($this->fileInfo);
        $stream = $fileInfo->openText();
        $this->assertTrue($stream instanceof StreamReader);
    }

    public function test_OpenWrite_CanGetFileStream() {
        $fileInfo = new FileInfo($this->fileInfo);
        $stream = $fileInfo->openWrite();
        $this->assertTrue($stream instanceof FileStream);
    }

    public function test_Replace_CanReplaceFile() {
        $fileInfo = new FileInfo($this->fileInfo);
        $newFile = $fileInfo->copyTo("system.io.fileInfo2.txt");
        $newFile->replace("system.io.fileInfo3.txt", "system.io.fileInfo.txt.bak");
        $this->fileExists($newFile->directoryName()."/system.io.fileInfo3.txt");
        $this->fileExists($newFile->directoryName()."/system.io.fileInfo.txt.bak");
    }
}

?>
