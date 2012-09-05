<?php

require_once dirname(__FILE__) . '/../../../system/io/DirectoryInfo.php';

use \System\IO\DirectoryInfo as DirectoryInfo;
use \System\IO\SearchOption as SearchOption;

class DirectoryInfoFixture extends PHPUnit_Framework_TestCase {

    protected $resourcesPath;
    protected $systemPath;

    public function setUp() {
        $this->resourcesPath = dirname(__FILE__) . "/../../resources/";
        $this->systemPath = dirname(__FILE__) . "/../../system";
    }

    public function test_Construct_ThrowsExceptionWhenNameIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        new DirectoryInfo(null);
    }

    public function test_Construct_ThrowsExceptionWhenNameContainsInvalidName() {
        $this->setExpectedException("\\System\\ArgumentException");
        new DirectoryInfo("dot*net*php");
    }

    public function test_Construct_ThrowsExceptionWhenPathIsLong() {
        $this->setExpectedException("\\System\\IO\\PathTooLongException");
        $pathName = "aokdfaoksdfoaksdfoaksodfkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaosko";
        new DirectoryInfo($pathName);
    }

    public function test_Create_ThrowsExceptionWhenCreateExistsDirectory() {
        $this->setExpectedException("\\System\\IO\\IOException");
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $directoryInfo->create();
    }

    public function test_Create_CanCreateDirectory() {
        $directoryInfo = new DirectoryInfo($this->resourcesPath."newDirectory");
        $directoryInfo->create();
        $this->assertTrue(file_exists($directoryInfo->fullName()));
        $directoryInfo->delete();
    }

    public function test_CreateSubDirectory_ThrowsExceptionWhenSizeOfPathNameIsGreaterThan248Characters() {
        $this->setExpectedException("\\System\\IO\\PathTooLongException");
        $pathName = "aokdfaoksdfoaksdfoaksodfkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaosko";
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $directoryInfo->createSubDirectory($pathName);
    }

    public function test_CreateSubDirectory_ThrowsExceptionWhenNameIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $directoryInfo->createSubDirectory(null);
    }

    public function test_CreateSubDirectory_ThrowsExceptionWhenNameContainsInvalidCharacteres() {
        $this->setExpectedException("\\System\\ArgumentException");
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $directoryInfo->createSubDirectory("a*sddf");
    }

    public function test_CreateSubDirectory_ThrowsExceptionWhenDirectoryExists() {
        $this->setExpectedException("\\System\\IO\\IOException");
        $testPath = realpath($this->resourcesPath.'../');
        $directoryInfo = new DirectoryInfo($testPath);
        $directoryInfo->createSubDirectory("resources");
    }

    public function test_CreateSubDirectory_CanCreateSubDirectory() {
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $subDirectory = $directoryInfo->createSubDirectory("newdirectory");
        $this->assertEquals("newdirectory", $subDirectory->name());
        $subDirectory->delete();
    }

    public function test_Delete_ThrowsExceptionWhenHasChildren() {
        $this->setExpectedException("\\System\\IO\\IOException");
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $directoryInfo->delete();
    }

    public function test_Delete_CanDeleteChildrenDirectories() {
        $directoryInfo = new DirectoryInfo($this->resourcesPath."newdirectory");
        $directoryInfo->create();
        $directoryInfo->createSubDirectory("deletada1");
        $directoryInfo->createSubDirectory("deletada2");
        $directoryInfo->createSubDirectory("deletada3");
        $directoryInfo->delete(true);
    }

    public function test_GetDirectories_CanGetChildrenDirectories() {
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $directories = $directoryInfo->getDirectories();
        $this->assertNotEquals("", $directories[0]->fullname());
    }

    public function test_GetDirectories_CanFindChildrenDirectories() {
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $directoryInfo->createSubDirectory("search1");
        $directoryInfo->createSubDirectory("search2");
        $directoryInfo->createSubDirectory("search3");
        $directories = $directoryInfo->getDirectories("/search/", SearchOption::TopDirectoryOnly);
        $this->assertEquals(3, sizeof($directories));
        $this->assertNotEquals("", $directories[0]->fullName());
        foreach($directories as $dic)
            $dic->delete();
    }


    public function test_GetDirectories_CanFindChildrenRecursive() {
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $children = $directoryInfo->createSubDirectory("search1");
        $children->createSubDirectory("search4");
        $directories = $directoryInfo->getDirectories("/search/", SearchOption::AllDirectories);
        $this->assertGreaterThanOrEqual(sizeof($directories), 2);
        $this->assertNotEquals("", $directories[0]->fullname());
        $children->delete(true);
    }

    public function test_GetFiles_ThrowsExceptionWhenSearchPatternIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $directoryInfo->getFiles(null);
    }

     public function test_GetFiles_CanGetFiles() {
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $this->assertGreaterThan(0, sizeof($directoryInfo->getFiles()));
     }

    public function test_GetFiles_CanFindFiles() {
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $this->assertGreaterThan(0, sizeof($directoryInfo->getFiles("/system*/")));
    }

    public function test_GetFiles_CanFindRecursive() {
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $files = $directoryInfo->getFiles("/system*/", SearchOption::AllDirectories);
        $this->assertGreaterThanOrEqual(1, sizeof($files));
    }

    public function test_GetFileSystemInfos_CanGetFileAndDirectories() {
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $fileSystem = $directoryInfo->getFileSystemInfos();
        $this->assertGreaterThanOrEqual(3, sizeof($fileSystem));
    }

    public function test_GetFileSystemInfos_CanFindFilesAndDirectories() {
        $directoryInfo = new DirectoryInfo($this->systemPath);
        $fileSystem = $directoryInfo->getFileSystemInfos("/collections*/");
        $this->assertGreaterThanOrEqual(1, sizeof($fileSystem));
    }

    public function test_MoveTo_CanMoveDirectoryWithoutChildren() {
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $sub = $directoryInfo->createSubDirectory("children");
        $sub->moveTo($this->systemPath);
        $this->assertTrue(file_exists($this->systemPath."/children"));
        $sub->delete(true);
    }


    public function test_MoveTo_CanMoveDirectoryWithChildren() {
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $sub = $directoryInfo->createSubDirectory("children");
        $sub->createSubDirectory("children2");
        $sub->moveTo($this->systemPath);
        $this->assertTrue(file_exists($this->systemPath."/children/children2"));
        rmdir($this->systemPath."/children/children2");
        rmdir($this->systemPath."/children");
    }

    public function test_Parent_GetParentDirectory() {
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $parent = $directoryInfo->parent();
        $this->assertEquals("tests", $parent->name());
    }

    public function test_Refresh_CanRefreshStatusOfObject() {
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $directoryInfo->refresh();
        $this->assertEquals("resources", $directoryInfo->name());
    }

    public function test_Root_CanGetRootPath() {
        $directoryInfo = new DirectoryInfo($this->resourcesPath);
        $root = $directoryInfo->root();
        $this->assertNotNull($root->name());
    }
}
?>
