<?php

use \System\IO\Directories as Directories;
use \System\DateTime as DateTime;

/**
 * @group io
*/
class DirectoriesTestCase extends PHPUnit_Framework_TestCase
{

    private function generateName() 
    {
        return '/tmp/' . md5(rand(1, 20).rand(21, 70).rand(71, 100));
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

    /**
     * @test
    */
    public function GetDirectories_CanGetDirectories() 
    {
        # Arrange:
        $name = $this->generateName();
        mkdir($name);

        # Act:
        $directories = Directories::getDirectories('/tmp');

        # Assert:
        $this->assertGreaterThan(0, sizeof($directories));
    }

    /**
     * @test
    */
    public function GetDirectoryRoot_CanGetRoot() 
    {
        # Arrange:
        $name = $this->generateName();
        
        # Act:
        $root = Directories::getDirectoryRoot($name);

        # Assert:
        $this->assertEquals('tmp', $root);
    }

    /**
     * @test
    */
    public function GetFiles_CanGetFiles() 
    {
        # Arrange:
        $name = $this->generateName();
        mkdir($name);

        for($i = 0; $i < 3; $i++)
        {
            $file = $name.'/'.md5(rand(1, 10).rand(11, 20)).'txt';
            fopen($file, 'w');
        }
        
        # Act:
        $files = Directories::getFiles($name);

        # Assert:
        $this->assertEquals(3, sizeof($files));
    }

    /**
     * @test
    */
    public function GetFileSystemEntries_CanGetFileSystemEntries() 
    {
        # Arrange:
        $name = $this->generateName();
        mkdir($name);

        for($i = 0; $i < 3; $i++)
        {
            $file = $name.'/'.md5(rand(1, 10).rand(11, 20)).'txt';
            fopen($file, 'w');
            mkdir($name.'/'.$i);
        }
        
        # Act:
        $files = Directories::getFileSytemEntries($name);

        # Assert:
        $this->assertEquals(6, sizeof($files));
    }

    /**
     * @test
    */
    public function GetLastAccessTime_CanGetLastAccessTime() 
    {
        # Arrange:
        $name = $this->generateName();
        mkdir($name);
        $date = getdate();

        # Act:
        $time = Directories::getLastAccessTime($name);

        # Assert:
        $this->assertEquals($date['year'], $time->year());
    }

    /**
     * @test
    */
    public function GetLastAccessTimeUtc_CanGetLastAccessTimeUtc() 
    {
        # Arrange:
        $name = $this->generateName();
        mkdir($name);
        $utc = getdate(strtotime(gmdate('Y-m-d H:m:s', mktime())));

        # Act:
        $time = Directories::getLastAccessTimeUtc($name);

        # Assert:
        $this->assertEquals($utc['year'], $time->year());
    }

    /**
     * @test
    */
    public function GetLastWriteTime_CanGetLastWriteTime() 
    {
        # Arrange:
        $name = $this->generateName();
        mkdir($name);
        $date = getdate();

        # Act:
        $time = Directories::getLastWriteTime($name);

        # Assert:
        $this->assertEquals($date['year'], $time->year());
    }

    /**
     * @test
    */
    public function GetLastWriteTimeUtc_CanGetLastAccessTimeUtc() 
    {
        # Arrange:
        $name = $this->generateName();
        mkdir($name);
        $utc = getdate(strtotime(gmdate('Y-m-d H:m:s', mktime())));

        # Act:
        $time = Directories::getLastWriteTimeUtc($name);

        # Assert:
        $this->assertEquals($utc['year'], $time->year());
    }


    /**
     * @test
    */
    public function GetParent_CanGetParent() 
    {
        # Arrange:
        $name = $this->generateName();
        mkdir($name);

        # Act:
        $parent = Directories::getParent($name);

        # Assert:
        $this->assertEquals('/tmp', $parent->fullName());
    }

    /**
     * @test
    */
    public function Move_CanMovePath() 
    {
        # Arrange:
        $name = $this->generateName();
        $destination = $this->generateName();
        $complete_path = $destination.'/'.str_replace('/tmp', "", $name);
        mkdir($name);
        mkdir($destination);

        # Act:
        Directories::move($name, $destination);
        
        # Assert:
        
        $this->assertTrue(file_exists($complete_path));
    }
}
