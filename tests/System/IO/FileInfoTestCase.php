<?php

use \System\IO\FileInfo as FileInfo;
use \System\IO\FileAttributes as FileAttributes;
use \System\IO\StreamWriter as StreamWriter;
use \System\IO\FileStream as FileStream;
use \System\IO\StreamReader as StreamReader;

/**
 * @group io
*/
class FileInfoTestCase extends PHPUnit_Framework_TestCase 
{

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

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function Constructor_ThrowsExceptionWhenFileNameIsNull() 
    {
        # Arrange:
        $file_name = null;
        
        # Act:
        new FileInfo($file_name);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function Constructor_ThrowsExceptionWhenArgumentIsInvalid() 
    {
        # Arrange:
        $file_name = "";
        
        # Act:
        new FileInfo($file_name);
    }

    /**
     * @test
     * @expectedException \System\IO\PathTooLongException
    */
    public function Constructor_ThrowsExceptionWhenPathIsTooLong() 
    {
        # Arrange:
        $file_name = str_pad('a', 249);
        
        # Act:
        new FileInfo($file_name);
    }


    /**
     * @test
    */
    public function Constructor_CanCreateFileInfoFromAnyFile() 
    {
         # Arrange:
        $name = $this->generateName();

        # Act:
        $info = new FileInfo($name);

        # Assert:
        $this->assertNotNull($info);
    }

    /**
     * @test
    */
    public function AppendText_ShouldCreateStreamWriter() 
    {
        # Arrange:
        $name = $this->generateName();
        $info = new FileInfo($name);
        $class_type = '\\System\\IO\\StreamWriter';

        # Act:
        $writer = $info->appendText();

        # Assert:
        $this->assertInstanceOf($class_type, $writer);
    }

    /**
     * @test
    */
    public function Attributes_CanGetAttributesFromFile() 
    {
        # Arrange:
        $name = $this->generateName();

        # Act:
        $info = new FileInfo($name);

        # Assert:
        $this->assertEquals(FileAttributes::archive(), $info->attributes());
    }

    /**
     * @test
    */
    public function Create_ShouldCreateFile() 
    {
        # Arrange:
        $name = $this->generateName();
        $info = new FileInfo($name);
    
        # Act:
        $stream = $info->create();
    
        # Assert:
        $this->assertTrue(file_exists($info->fullName()));

        # Post:
        $info->delete();
    }

    /**
     * @test
    */
    public function CreationTime_GetWhenFileWasCreated() 
    {
        # Arrange:
        $name = $this->generateName();
        $date = getdate();

        # Act:
        $info = new FileInfo($name);

        # Assert:
        $this->assertEquals($date['year'], $info->creationTime()->year());
    }

    /**
     * @test
    */
    public function CreationTimeUtc_GetWhenFileWasCreateInUtc() 
    {
        # Arrange:
        $name = $this->generateName();
        $utc = getdate(strtotime(gmdate('Y-m-d H:m:s')));

        # Act:
        $info = new FileInfo($name);

        # Assert:
        $this->assertEquals($utc['year'], $info->creationTime()->year());
    }

    /**
     * @test
    */
    public function Exists_ShouldBeFalseWhenFileNotExists() 
    {
        # Arrange:
        $name = $this->generateName();

        # Act:
        $info = new FileInfo($name);

        # Assert:
        $this->assertFalse($info->exists());
    }

    /**
     * @test
    */
    public function Exists_ShouldBeTrueWhenFileExists() 
    {
         # Arrange:
        $name = $this->generateFile();

        # Act:
        $info = new FileInfo($name);

        # Assert:
        $this->assertTrue($info->exists());

        # Post:
        $info->delete();
    }

    /**
     * @test
    */
    public function Extension_CanGetExtension() 
    {
        # Arrange:
        $name = $this->generateName();

        # Act:
        $info = new FileInfo($name);

        # Assert:
        $this->assertEquals('txt', $info->extension());
    }

    /**
     * @test
    */
    public function FullName_CanGetFullName() 
    {
        # Arrange:
        $name = $this->generateName();

        # Act:
        $info = new FileInfo($name);

        # Assert:
        $this->assertEquals($name, $info->fullName());
    }

    /**
     * @test
    */
    public function LastAccess_CanGetLastAccess() 
    {
        # Arrange:
        $name = $this->generateName();
        $date = getdate();

        # Act:
        $info = new FileInfo($name);

        # Assert:
        $this->assertEquals($date['year'], $info->lastAccessTime()->year());
    }

    /**
     * @test
    */
    public function LastAccessUtc_CanGetLastAccessInUtcFormat() 
    {
        # Arrange:
        $name = $this->generateName();
        $utc = getdate(strtotime(gmdate('Y-m-d H:m:s')));

        # Act:
        $info = new FileInfo($name);

        # Assert:
        $this->assertEquals($utc['year'], $info->lastAccessTimeUtc()->year());
    }

    /**
     * @test
    */
    public function LastWrite_CanGetLastWrite() 
    {
        # Arrange:
        $name = $this->generateName();
        $utc = getdate();

        # Act:
        $info = new FileInfo($name);

        # Assert:
        $this->assertEquals($utc['year'], $info->lastWriteTime()->year());
    }

    /**
     * @test
    */
    public function LastWriteUtc_CanGetLastWriteInUtcFormat() 
    {
        # Arrange:
        $name = $this->generateName();
        $utc = getdate(strtotime(gmdate('Y-m-d H:m:s')));

        # Act:
        $info = new FileInfo($name);

        # Assert:
        $this->assertEquals($utc['year'], $info->lastWriteTimeUtc()->year());
    }

    /**
     * @test
    */
    public function Name_CanGetNameOfFile() 
    {
        # Arrange:
        $name = $this->generateName();
        $path_info = pathinfo($name);
        $complete_path = $path_info['filename'].'.'.$path_info['extension'];

        # Act:
        $info = new FileInfo($name);

        # Assert:
        $this->assertEquals($complete_path, $info->name());
    }

    /**
     * @test
    */
    public function Directory_CanGetDirectoryInfo() 
    {
        # Arrange:
        $name = $this->generateName();
        $info = new FileInfo($name);

        # Act:
        $dir = $info->directory();

        # Assert:
        $this->assertEquals('/tmp', $dir->fullName());
    }

    /**
     * @test
    */
    public function DirectoryName_CanGetNameOfParentDirectory() 
    {
        # Arrange:
        $name = $this->generateName();
        $info = new FileInfo($name);

        # Act:
        $dir = $info->directoryName();

        # Assert:
        $this->assertEquals('/tmp', $dir);
    }

    // /**
    //  * @test
    // */
    // public function IsReadOnly_CanGetInformationIfFileIsReadOnly() 
    // {
    //     $fileInfo = new FileInfo($this->fileInfo);
    //     $this->assertFalse($fileInfo->isReadOnly());
    // }

    // /**
    //  * @test
    // */
    // public function Length_CanGetLengthOfFile() {
    //     $fileInfo = new FileInfo($this->fileInfo);
    //     $this->assertEquals(17, $fileInfo->length());
    // }

    // /**
    //  * @test
    // */
    // public function AppendText_WhenAppendTextShouldReturnStreamWriterInstance() {
    //     $fileInfo = new FileInfo($this->fileInfo);
    //     $writer = $fileInfo->appendText();
    //     $this->assertTrue($writer instanceof StreamWriter);
    // }

    // /**
    //  * @test
    // */
    // public function CopyTo_CanCopyToAnotherFile() {
    //     $fileInfo = new FileInfo($this->fileInfo);
    //     $newFile = $fileInfo->copyTo("system.io.fileInfo2.txt");
    //     $this->assertTrue(file_exists($newFile->fullName()));
    // }

    // /**
    //  * @test
    // */
    // public function CopyTo_OverwriteIfFileExists() {
    //     $fileInfo = new FileInfo($this->fileInfo);
    //     $newFile = $fileInfo->copyTo("system.io.fileInfo.txt", true);
    //     $this->assertTrue(file_exists($newFile->fullName()));
    // }

    // /**
    //  * @test
    // */
    // public function Create_CanCreateFileStream() {
    //     $fileInfo = new FileInfo($this->fileInfo);
    //     $stream = $fileInfo->create();
    //     $this->assertTrue($stream instanceof FileStream);
    // }

    // /**
    //  * @test
    // */
    // public function CreateText_CanCreateTextFile() {
    //     $fileInfo = new FileInfo($this->fileInfo);
    //     $stream = $fileInfo->createText();
    //     $this->assertTrue($stream instanceof StreamWriter);
    // }

    // /**
    //  * @test
    // */
    // public function Delete_ShouldDeleteAnyFile() {
    //     $fileInfo = new FileInfo($this->fileInfo);
    //     $newFile = $fileInfo->copyTo("system.io.fileInfo2.txt", true);
    //     $newFile->delete();
    //     $this->assertFalse(file_exists($newFile->fullName()));
    // }

    // /**
    //  * @test
    // */
    // public function MoveTo_ThrowsExceptionWhenFileExists() {
    //     $this->setExpectedException("\\System\\IO\\IOException");
    //     $fileInfo = new FileInfo($this->fileInfo);
    //     $newFile = $fileInfo->copyTo("system.io.fileInfo2.txt", true);
    //     $newFile->moveTo("system.io.fileInfo.txt");
    // }


    // /**
    //  * @test
    // */
    // public function MoveTo_CanMoveFile() {
    //     $fileInfo = new FileInfo($this->fileInfo);
    //     $newFile = $fileInfo->copyTo("system.io.fileInfo2.txt", true);
    //     $newFile->moveTo("system.io.fileInfo3.txt");
    //     $this->assertTrue(file_exists($newFile->directoryName()."/system.io.fileInfo3.txt"));
    // }

    // /**
    //  * @test
    // */
    // public function Open_CanGetFileStream() {
    //     $fileInfo = new FileInfo($this->fileInfo);
    //     $stream = $fileInfo->open();
    //     $this->assertTrue($stream instanceof FileStream);
    // }

    // /**
    //  * @test
    // */
    // public function OpenRead_CanGetFileStream() {
    //     $fileInfo = new FileInfo($this->fileInfo);
    //     $stream = $fileInfo->open();
    //     $this->assertTrue($stream instanceof FileStream);
    // }

    // /**
    //  * @test
    // */
    // public function OpenText_CanGetStreamReader() {
    //     $fileInfo = new FileInfo($this->fileInfo);
    //     $stream = $fileInfo->openText();
    //     $this->assertTrue($stream instanceof StreamReader);
    // }

    // /**
    //  * @test
    // */
    // public function OpenWrite_CanGetFileStream() {
    //     $fileInfo = new FileInfo($this->fileInfo);
    //     $stream = $fileInfo->openWrite();
    //     $this->assertTrue($stream instanceof FileStream);
    // }

    // /**
    //  * @test
    // */
    // public function Replace_CanReplaceFile() {
    //     $fileInfo = new FileInfo($this->fileInfo);
    //     $newFile = $fileInfo->copyTo("system.io.fileInfo2.txt");
    //     $newFile->replace("system.io.fileInfo3.txt", "system.io.fileInfo.txt.bak");
    //     $this->fileExists($newFile->directoryName()."/system.io.fileInfo3.txt");
    //     $this->fileExists($newFile->directoryName()."/system.io.fileInfo.txt.bak");
    // }
}
