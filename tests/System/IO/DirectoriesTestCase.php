<?php

use \System\IO\Directories as Directories;

/**
 * @group io
*/
class DirectoriesTestCase extends PHPUnit_Framework_TestCase 
{

    private function generateName() 
    {
        return '/tmp/' . md5(rand(1, 99).rand(1, 10)) ;
    }

    /**
     * @test
    */
    public function CreateDirectory_CanCreateDirectory() {
        
        # Arrange:
        $name = $this->generateName();

        # Act:
        $info = Directories::createDirectory($name);
        
        # Assert:
        $this->assertTrue(file_exists($name));
        
        # Post:
        $info->delete();
    }

    /**
     * @test
    */
    public function Delete_CanDeleteDirectory() 
    {
        # Arrange:
        $name = $this->generateName();
        mkdir($name);

        # Act:
        Directories::delete($name);

        # Assert:
        $this->assertFalse(file_exists($name));
    }

    /**
     * @test
    */
    public function Exists_ShouldBeTrueIfFileExists() 
    {
        # Arrange:
        $name = $this->generateName();
        mkdir($name);

        # Act:
        $exists = Directories::exists($name);

        # Assert:
        $this->assertTrue($exists);

        # Post:
        rmdir($name);
    }

    /**
     * @test
    */
    public function Exists_ShouldBeFalseIfFileNotExists()
    {
        # Arrange:
        $name = $this->generateName();

        # Act:
        $exists = Directories::exists($name);

        # Assert:
        $this->assertFalse($exists);
    }

    /**
     * @test
    */
    public function GetCreationTime_ShouldGetCreationTime() 
    {
        # Arrange:
        $name = $this->generateName();
        mkdir($name);

        # Act:
        $creationTime = Directories::getCreationTime($name);

        # Assert:
        $this->assertTrue($creationTime->year() > 2010);

        # Post:
        rmdir($name);
    }

    /**
     * @test
    */
    public function GetCreationUtcTime_ShouldGetCreationTimeUtc() 
    {
        # Arrange:
        $name = $this->generateName();
        mkdir($name);

        # Act:
        $creationTime = Directories::getCreationTimeUtc($name);

        # Assert:
        $this->assertTrue($creationTime->year() > 2010);

        # Post:
        rmdir($name);
    }

    /**
     * @test
    */
    public function GetCurrentDirectory_CanCurrentGetDirectory() 
    {
        # Arrange:
        $repo_name = 'dotnetonphp';

        # Act:
        $current = Directories::getCurrentDirectory();

        # Assert:
        $this->assertTrue(strpos($current, $repo_name) !== false);
    }

    // /**
    //  * @test
    // */
    // public function GetDirectories_CanGetDirectories() 
    // {
    //     # Arrange:
    //     $name = $this->generateName();
    //     mkdir($name);

    //     # Act:
    //     $directories = Directories::getDirectories('/tmp/');

    //     # Assert:
    //     $this->assertGreaterThan(0, sizeof($directories));

    //     # Post:
    //     rmdir($name);
    // }

    // /**
    //  * @test
    // */
    // public function GetDirectoryRoot_CanGetRoot() {
    //     $root = Directories::getDirectoryRoot($this->resourcesPath);
    //     $this->assertNotNull($root);
    // }

    // /**
    //  * @test
    // */
    // public function GetFiles_CanGetFiles() {
    //     $files = Directories::getFiles($this->resourcesPath);
    //     $this->assertGreaterThan(0, sizeof($files));
    // }

    // /**
    //  * @test
    // */
    // public function GetFileSystemEntries_CanGetFileSystemEntries() {
    //     $entries = Directories::getFileSytemEntries($this->resourcesPath.'/../');
    //     $this->assertGreaterThan(0, sizeof($entries));
    // }

    // /**
    //  * @test
    // */
    // public function GetLastAccessTime_CanGetLastAccessTime() {
    //     $accessTime = Directories::getLastAccessTime($this->resourcesPath);
    //     $this->assertNotNull($accessTime);
    // }

    // /**
    //  * @test
    // */
    // public function GetLastAccessTimeUtc_CanGetLastAccessTimeUtc() {
    //     $accessTimeUtc = Directories::getLastAccessTime($this->resourcesPath);
    //     $this->assertNotNull($accessTimeUtc);
    // }

    // /**
    //  * @test
    // */
    // public function GetLastWriteTime_CanGetLastWriteTime() {
    //     $writeTime = Directories::getLastWriteTime($this->resourcesPath);
    //     $this->assertNotNull($writeTime);
    // }

    // /**
    //  * @test
    // */
    // public function GetLastWriteTimeUtc_CanGetLastAccessTimeUtc() {
    //     $accessTimeUtc = Directories::getLastWriteTimeUtc($this->resourcesPath);
    //     $this->assertNotNull($accessTimeUtc);
    // }

    // /**
    //  * @test
    // */
    // public function GetLogicalDrivers_CanGetLogicalName() {
    //     $driverName = Directories::getLogicalDrivers();
    //     $this->assertNotNull($driverName);
    // }

    // /**
    //  * @test
    // */
    // public function GetParent_CanGetParent() {
    //     $parent = Directories::getParent($this->resourcesPath);
    //     $this->assertNotNull($parent);
    // }

    // /**
    //  * @test
    // */
    // public function Move_CanMovePath() {
    //     Directories::createDirectory($this->resourcesPath.'/newDirectory');
    //     Directories::createDirectory($this->resourcesPath.'/newDirectory2');
    //     Directories::move($this->resourcesPath.'/newDirectory', $this->resourcesPath.'/newDirectory2');
    //     Directories::delete($this->resourcesPath.'/newDirectory2', true);
    // }
}
