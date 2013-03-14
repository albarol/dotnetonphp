<?php

use \System\IO\DirectoryInfo as DirectoryInfo;
use \System\IO\SearchOption as SearchOption;


class DirectoryInfoFixture extends PHPUnit_Framework_TestCase 
{

    private function generateName() 
    {
        return '/tmp/' . md5(rand(1, 99).rand(1, 10)) ;
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function Construct_ThrowsExceptionWhenNameIsNull() 
    {
        # Arrange:
        # Act:
        new DirectoryInfo(null);
    }


    /**
     * @test
     * @expectedException \System\IO\PathTooLongException
    */
    public function Construct_ThrowsExceptionWhenPathIsLong() 
    {
        # Arrange:
        $name = str_pad('a', 249);

        # Act:
        new DirectoryInfo($name);
    }

    /**
     * @test
    */
    public function Construct_ShouldGetObjectDirectoryInfo() {
        
        # Arrange:
        $name = $this->generateName();
        mkdir($name);
        
        # Act:
        $info = new DirectoryInfo($name);
    
        # Assert:
        $this->assertNotNull($info);
    }

    /**
     * @test
     * @expectedException \System\IO\IOException
    */
    public function Create_ThrowsExceptionWhenCreateExistsDirectory() 
    {
        # Arrange:
        $name = $this->generateName();
        mkdir($name);
        $info = new DirectoryInfo($name);

        # Act:
        $info->create();

        # Post
        rmdir($name);
    }

    // /**
    //  * @test
    // */
    // public function Create_CanCreateDirectory() {
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath."newDirectory");
    //     $directoryInfo->create();
    //     $this->assertTrue(file_exists($directoryInfo->fullName()));
    //     $directoryInfo->delete();
    // }

    // /**
    //  * @test
    // */
    // public function CreateSubDirectory_ThrowsExceptionWhenSizeOfPathNameIsGreaterThan248Characters() {
    //     $this->setExpectedException("\\System\\IO\\PathTooLongException");
    //     $pathName = "aokdfaoksdfoaksdfoaksodfkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaosko";
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $directoryInfo->createSubDirectory($pathName);
    // }

    // /**
    //  * @test
    // */
    // public function CreateSubDirectory_ThrowsExceptionWhenNameIsNull() {
    //     $this->setExpectedException("\\System\\ArgumentNullException");
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $directoryInfo->createSubDirectory(null);
    // }

    // /**
    //  * @test
    // */
    // public function CreateSubDirectory_ThrowsExceptionWhenNameContainsInvalidCharacteres() {
    //     $this->setExpectedException("\\System\\ArgumentException");
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $directoryInfo->createSubDirectory("a*sddf");
    // }

    // /**
    //  * @test
    // */
    // public function CreateSubDirectory_ThrowsExceptionWhenDirectoryExists() {
    //     $this->setExpectedException("\\System\\IO\\IOException");
    //     $testPath = realpath($this->resourcesPath.'../');
    //     $directoryInfo = new DirectoryInfo($testPath);
    //     $directoryInfo->createSubDirectory("resources");
    // }

    // /**
    //  * @test
    // */
    // public function CreateSubDirectory_CanCreateSubDirectory() {
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $subDirectory = $directoryInfo->createSubDirectory("newdirectory");
    //     $this->assertEquals("newdirectory", $subDirectory->name());
    //     $subDirectory->delete();
    // }

    // /**
    //  * @test
    // */
    // public function Delete_ThrowsExceptionWhenHasChildren() {
    //     $this->setExpectedException("\\System\\IO\\IOException");
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $directoryInfo->delete();
    // }

    // /**
    //  * @test
    // */
    // public function Delete_CanDeleteChildrenDirectories() {
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath."newdirectory");
    //     $directoryInfo->create();
    //     $directoryInfo->createSubDirectory("deletada1");
    //     $directoryInfo->createSubDirectory("deletada2");
    //     $directoryInfo->createSubDirectory("deletada3");
    //     $directoryInfo->delete(true);
    // }

    // /**
    //  * @test
    // */
    // public function GetDirectories_CanGetChildrenDirectories() {
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $directories = $directoryInfo->getDirectories();
    //     $this->assertNotEquals("", $directories[0]->fullname());
    // }

    // /**
    //  * @test
    // */
    // public function GetDirectories_CanFindChildrenDirectories() {
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $directoryInfo->createSubDirectory("search1");
    //     $directoryInfo->createSubDirectory("search2");
    //     $directoryInfo->createSubDirectory("search3");
    //     $directories = $directoryInfo->getDirectories("/search/", SearchOption::TopDirectoryOnly);
    //     $this->assertEquals(3, sizeof($directories));
    //     $this->assertNotEquals("", $directories[0]->fullName());
    //     foreach($directories as $dic)
    //         $dic->delete();
    // }


    // /**
    //  * @test
    // */
    // public function GetDirectories_CanFindChildrenRecursive() {
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $children = $directoryInfo->createSubDirectory("search1");
    //     $children->createSubDirectory("search4");
    //     $directories = $directoryInfo->getDirectories("/search/", SearchOption::AllDirectories);
    //     $this->assertGreaterThanOrEqual(sizeof($directories), 2);
    //     $this->assertNotEquals("", $directories[0]->fullname());
    //     $children->delete(true);
    // }

    // /**
    //  * @test
    // */
    // public function GetFiles_ThrowsExceptionWhenSearchPatternIsNull() {
    //     $this->setExpectedException("\\System\\ArgumentNullException");
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $directoryInfo->getFiles(null);
    // }

    //  /**
    //  * @test
    // */
    // public function GetFiles_CanGetFiles() {
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $this->assertGreaterThan(0, sizeof($directoryInfo->getFiles()));
    //  }

    // /**
    //  * @test
    // */
    // public function GetFiles_CanFindFiles() {
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $this->assertGreaterThan(0, sizeof($directoryInfo->getFiles("/system*/")));
    // }

    // /**
    //  * @test
    // */
    // public function GetFiles_CanFindRecursive() {
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $files = $directoryInfo->getFiles("/system*/", SearchOption::AllDirectories);
    //     $this->assertGreaterThanOrEqual(1, sizeof($files));
    // }

    // /**
    //  * @test
    // */
    // public function GetFileSystemInfos_CanGetFileAndDirectories() {
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $fileSystem = $directoryInfo->getFileSystemInfos();
    //     $this->assertGreaterThanOrEqual(3, sizeof($fileSystem));
    // }

    // /**
    //  * @test
    // */
    // public function GetFileSystemInfos_CanFindFilesAndDirectories() {
    //     $directoryInfo = new DirectoryInfo($this->systemPath);
    //     $fileSystem = $directoryInfo->getFileSystemInfos("/collections*/");
    //     $this->assertGreaterThanOrEqual(1, sizeof($fileSystem));
    // }

    // /**
    //  * @test
    // */
    // public function MoveTo_CanMoveDirectoryWithoutChildren() {
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $sub = $directoryInfo->createSubDirectory("children");
    //     $sub->moveTo($this->systemPath);
    //     $this->assertTrue(file_exists($this->systemPath."/children"));
    //     $sub->delete(true);
    // }


    // /**
    //  * @test
    // */
    // public function MoveTo_CanMoveDirectoryWithChildren() {
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $sub = $directoryInfo->createSubDirectory("children");
    //     $sub->createSubDirectory("children2");
    //     $sub->moveTo($this->systemPath);
    //     $this->assertTrue(file_exists($this->systemPath."/children/children2"));
    //     rmdir($this->systemPath."/children/children2");
    //     rmdir($this->systemPath."/children");
    // }

    // /**
    //  * @test
    // */
    // public function Parent_GetParentDirectory() {
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $parent = $directoryInfo->parent();
    //     $this->assertEquals("tests", $parent->name());
    // }

    // /**
    //  * @test
    // */
    // public function Refresh_CanRefreshStatusOfObject() {
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $directoryInfo->refresh();
    //     $this->assertEquals("resources", $directoryInfo->name());
    // }

    // /**
    //  * @test
    // */
    // public function Root_CanGetRootPath() {
    //     $directoryInfo = new DirectoryInfo($this->resourcesPath);
    //     $root = $directoryInfo->root();
    //     $this->assertNotNull($root->name());
    // }
}
