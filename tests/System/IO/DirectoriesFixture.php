<?php

require_once dirname(__FILE__) . '/../../../src/Autoloader.php';

use \System\IO\Directories as Directories;

class DirectoriesFixture extends PHPUnit_Framework_TestCase {

    protected $resourcesPath;
    protected $newDirectory;

    public function setUp() {
        $this->resourcesPath = dirname(__FILE__) . "/../../resources/";
        $this->newDirectory = $this->resourcesPath.'newDirectory';
    }

    public function test_CreateDirectory_ThrowsExceptionWhenPathIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        Directories::createDirectory(null);
    }

    public function test_CreateDirectory_ThrowsExceptionWhenArgumentIsInvalid() {
        $this->setExpectedException("\\System\\ArgumentException");
        Directories::createDirectory("d*ot");
    }

    public function test_CreateDirectory_CanCreateDirectory() {
        $directoryInfo = Directories::createDirectory($this->newDirectory);
        $this->assertTrue(file_exists($this->newDirectory));
        $directoryInfo->delete();
    }

    public function test_Delete_CanDeleteDirectory() {
        Directories::createDirectory($this->newDirectory);
        Directories::delete($this->newDirectory);
    }

    public function test_Exists_ShouldBeTrueIfFileExists() {
        $exists = Directories::exists($this->resourcesPath);
        $this->assertTrue($exists);
    }

    public function test_Exists_ShouldBeFalseIfFileNotExists(){
        $exists = Directories::exists($this->newDirectory);
        $this->assertFalse($exists);
    }

    public function test_GetCreationTime_ShouldGetCreationTime() {
        $creationTime = Directories::getCreationTime($this->resourcesPath);
        $this->assertNotNull($creationTime);
    }

    public function test_GetCreationUtcTime_ShouldGetCreationTimeUtc() {
        $creationTime = Directories::getCreationTimeUtc($this->resourcesPath);
        $this->assertNotNull($creationTime);
    }

    public function test_GetCurrentDirectory_CanCurrentGetDirectory() {
        $currentDirectory = Directories::getCurrentDirectory();
        $this->assertNotNull($currentDirectory);
    }

    public function test_GetDirectories_CanGetDirectories() {
        $directories = Directories::getDirectories($this->resourcesPath.'/../');
        $this->assertGreaterThan(0, sizeof($directories));
    }

    public function test_GetDirectoryRoot_CanGetRoot() {
        $root = Directories::getDirectoryRoot($this->resourcesPath);
        $this->assertNotNull($root);
    }

    public function test_GetFiles_CanGetFiles() {
        $files = Directories::getFiles($this->resourcesPath);
        $this->assertGreaterThan(0, sizeof($files));
    }

    public function test_GetFileSystemEntries_CanGetFileSystemEntries() {
        $entries = Directories::getFileSytemEntries($this->resourcesPath.'/../');
        $this->assertGreaterThan(0, sizeof($entries));
    }

    public function test_GetLastAccessTime_CanGetLastAccessTime() {
        $accessTime = Directories::getLastAccessTime($this->resourcesPath);
        $this->assertNotNull($accessTime);
    }

    public function test_GetLastAccessTimeUtc_CanGetLastAccessTimeUtc() {
        $accessTimeUtc = Directories::getLastAccessTime($this->resourcesPath);
        $this->assertNotNull($accessTimeUtc);
    }

    public function test_GetLastWriteTime_CanGetLastWriteTime() {
        $writeTime = Directories::getLastWriteTime($this->resourcesPath);
        $this->assertNotNull($writeTime);
    }

    public function test_GetLastWriteTimeUtc_CanGetLastAccessTimeUtc() {
        $accessTimeUtc = Directories::getLastWriteTimeUtc($this->resourcesPath);
        $this->assertNotNull($accessTimeUtc);
    }

    public function test_GetLogicalDrivers_CanGetLogicalName() {
        $driverName = Directories::getLogicalDrivers();
        $this->assertNotNull($driverName);
    }

    public function test_GetParent_CanGetParent() {
        $parent = Directories::getParent($this->resourcesPath);
        $this->assertNotNull($parent);
    }

    public function test_Move_CanMovePath() {
        Directories::createDirectory($this->resourcesPath.'/newDirectory');
        Directories::createDirectory($this->resourcesPath.'/newDirectory2');
        Directories::move($this->resourcesPath.'/newDirectory', $this->resourcesPath.'/newDirectory2');
        Directories::delete($this->resourcesPath.'/newDirectory2', true);
    }
}
?>
