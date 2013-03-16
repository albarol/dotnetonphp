<?php

use \System\IO\DirectoryInfo as DirectoryInfo;
use \System\IO\SearchOption as SearchOption;


class DirectoryInfoTestCase extends PHPUnit_Framework_TestCase
{

    private function generateName() 
    {
        return '/tmp/' . md5(rand(1, 20).rand(21, 70).rand(71, 100));
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

    /**
     * @test
    */
    public function Create_CanCreateDirectory() 
    {
        # Arrange:
        $name = $this->generateName();
        $info = new DirectoryInfo($name);

        # Act:
        $info->create();

        # Assert:
        $this->assertTrue(file_exists($name));

        # Post:
        $info->delete();
    }

    /**
     * @test
     * @expectedException \System\IO\PathTooLongException
    */
    public function CreateSubDirectory_ThrowsExceptionWhenPathIsLong() 
    {
        # Arrange:
        $name = $this->generateName();
        $sub_name = str_pad('a', 249);
        $info = new DirectoryInfo($name);

        # Act:
        $info->createSubDirectory($sub_name);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function CreateSubDirectory_ThrowsExceptionWhenNameIsNull() 
    {
        # Arrange:
        $name = $this->generateName();
        $info = new DirectoryInfo($name);

        # Act:
        $info->createSubDirectory(null);
    }

    /**
     * @test
     * @expectedException \System\IO\IOException
    */
    public function CreateSubDirectory_ThrowsExceptionWhenDirectoryExists() {
        # Arrange:
        $name = $this->generateName();
        $sub_name = md5(rand(1, 50).rand(51,99));
        mkdir($name);
        mkdir($name.'/'.$sub_name);
        $info = new DirectoryInfo($name);

        # Act:
        $info->createSubDirectory($sub_name);

        # Post:
        $info->delete(true);
    }

    /**
     * @test
    */
    public function CreateSubDirectory_CanCreateSubDirectory() 
    {
        # Arrange:
        $name = $this->generateName();
        $sub_name = md5(rand(1, 50).rand(51,99));
        $info = new DirectoryInfo($name);
        $info->create();
    
        # Act:
        $child = $info->createSubDirectory($sub_name);
    
        # Assert:
        $this->assertTrue(file_exists($child->fullName()));

        # Post:
        $info->delete(true);
    }

    /**
     * @test
    */
    public function CreateSubDirectory_ShouldCreateParentDirectoryWhenNotExists() 
    {
        # Arrange:
        $name = $this->generateName();
        $sub_name = md5(rand(1, 50).rand(51,99));
        $info = new DirectoryInfo($name);
    
        # Act:
        $info->createSubDirectory($sub_name);
    
        # Assert:
        $this->assertTrue(file_exists($info->fullName()));

        # Post:
        $info->delete(true);
    }

    /**
     * @test
     * @expectedException \System\IO\IOException
    */
    public function Delete_ThrowsExceptionWhenHasChildren() 
    {
        # Arrange:
        $name = $this->generateName();
        $sub_name = $name.'/'.md5(rand(1, 50).rand(51,99));
        mkdir($name);
        mkdir($sub_name);
        $info = new DirectoryInfo($name);
    
        # Act:
        $info->delete();
    }

    /**
     * @test
     * @expectedException \System\IO\IOException
    */
    public function Delete_ThrowsExceptionWhenDirectoryNotExists() {
        
        # Arrange:
        $name = $this->generateName();
        $info = new DirectoryInfo($name);
    
        # Act:
        $info->delete();
    }

    /**
     * @test
    */
    public function Delete_ShouldDeleteDirectory() {
        
        # Arrange:
        $name = $this->generateName();
        mkdir($name);
        $info = new DirectoryInfo($name);
    
        # Act:
        $info->delete();
    
        # Assert:
        $this->assertFalse(file_exists($info->fullName()));
    }

    /**
     * @test
    */
    public function Delete_CanDeleteChildrenDirectories() 
    {
        # Arrange:
        $info = new DirectoryInfo($this->generateName());
        for ($i = 0; $i < 3; $i++) 
        { 
            $sub_name = md5($i);
            $info->createSubDirectory($sub_name);
        }
    
        # Act:
        $info->delete(true);
    
        # Assert:
        $this->assertFalse(file_exists($info->fullName()));
    }


    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function GetDirectories_ThrowsExceptionWhenPatternIsNull() 
    {
        
        # Arrange:
        $info = new DirectoryInfo($this->generateName());
    
        # Act:
        $info->getDirectories(null);
    }

    /**
     * @test
    */
    public function GetDirectories_CanGetChildrenDirectories() 
    {
        # Arrange:
        $info = new DirectoryInfo($this->generateName());
        for ($i = 0; $i < 3; $i++) 
        { 
            $sub_name = md5($i);
            $info->createSubDirectory($sub_name);
        }

        # Act:
        $dirs = $info->getDirectories();

        # Assert:
        $this->assertGreaterThan(0, sizeof($dirs));

        # Post:
        $info->delete(true);
    }

    /**
     * @test
    */
    public function GetDirectories_CanFindChildrenDirectoriesTopLevel() 
    {
        # Arrange:
        $info = new DirectoryInfo($this->generateName());
        for ($i = 0; $i < 3; $i++) 
        { 
            $sub_name = 'path_'.$i;
            $info->createSubDirectory($sub_name);
        }

        # Act:
        $dirs = $info->getDirectories('/path/', SearchOption::topDirectoryOnly());

        # Assert:
        $this->assertGreaterThan(0, sizeof($dirs));

        # Post:
        $info->delete(true);
    }


    /**
     * @test
    */
    public function GetDirectories_CanFindChildrenRecursive() 
    {
        # Arrange:
        $info = new DirectoryInfo($this->generateName());
        $sub = $info->createSubDirectory('children');
        for ($i = 0; $i < 3; $i++) 
        { 
            $sub_name = 'path_'.$i;
            $sub = $sub->createSubDirectory($sub_name);
        }

        # Act:
        $dirs = $info->getDirectories('/path/', SearchOption::allDirectories());

        # Assert:
        $this->assertEquals(3, sizeof($dirs));

        # Post:
        $info->delete(true);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function GetFiles_ThrowsExceptionWhenPatternIsNull() 
    {
        # Arrange:
        $info = new DirectoryInfo($this->generateName());

        # Act:
        $files = $info->getFiles(null);
    }

    /**
     * @test
    */
    public function GetFiles_CanGetFiles() 
    {
        # Arrange:
        $info = new DirectoryInfo($this->generateName());
        $info->create();

        for ($i = 0; $i < 3; $i++) 
        { 
            fopen($info->fullName().'/'.$i.'.txt', 'w');
        }

        # Act:
        $files = $info->getFiles();

        # Assert:
        $this->assertEquals(3, sizeof($files));

        # Post:
        $info->delete(true);
     }

    /**
     * @test
    */
    public function GetFiles_CanFindChildrenFilesTopLevel() 
    {
        # Arrange:
        $info = new DirectoryInfo($this->generateName());
        $info->create();

        for ($i = 0; $i < 3; $i++) 
        { 
            fopen($info->fullName().'/'.$i.'.txt', 'w');
        }

        # Act:
        $files = $info->getFiles('/0/');

        # Assert:
        $this->assertEquals(1, sizeof($files));

        # Post:
        $info->delete(true);
    }

    /**
     * @test
    */
    public function GetFiles_CanFindChildrenFilesRecursive() 
    {
        # Arrange:
        $info = new DirectoryInfo($this->generateName());
        $sub = $info->createSubDirectory('path');

        for ($i = 0; $i < 3; $i++) 
        { 
            fopen($sub->fullName().'/'.$i.'.txt', 'w');
        }

        # Act:
        $files = $info->getFiles('/0/', SearchOption::allDirectories());

        # Assert:
        $this->assertEquals(1, sizeof($files));

        # Post:
        $info->delete(true);
    }

    /**
     * @test
    */
    public function GetFileSystemInfos_CanGetFileAndDirectories() 
    {
        # Arrange:
        $info = new DirectoryInfo($this->generateName());

        for ($i = 0; $i < 3; $i++) 
        { 
            $info->createSubDirectory($i);
            fopen($info->fullName().'/'.$i.'.txt', 'w');
        }

        # Act:
        $systemInfos = $info->getFileSystemInfos();

        # Assert:
        $this->assertEquals(6, sizeof($systemInfos));

        # Post:
        $info->delete(true);
    }


    /**
     * @test
    */
    public function GetFileSystemInfos_CanFindFilesAndDirectories() 
    {
        # Arrange:
        $info = new DirectoryInfo($this->generateName());

        for ($i = 0; $i < 3; $i++) 
        { 
            $info->createSubDirectory($i);
            fopen($info->fullName().'/'.$i.'.txt', 'w');
        }

        # Act:
        $systemInfos = $info->getFileSystemInfos('/0/');

        # Assert:
        $this->assertEquals(2, sizeof($systemInfos));

        # Post:
        $info->delete(true);
    }

    /**
     * @test
     * @expectedException \System\ArgumentNullException
    */
    public function MoveTo_ThrowsExceptionWhenPathIsNull() {
        
        # Arrange:
        $info = new DirectoryInfo($this->generateName());
    
        # Act:
        $info->moveTo(null);
    }

    /**
     * @test
     * @expectedException \System\ArgumentException
    */
    public function MoveTo_ThrowsExceptionWhenDestinationExists() 
    {
        # Arrange:
        $name = $this->generateName();
        $destination = $this->generateName();
        $info = new DirectoryInfo($this->generateName());
        mkdir($destination);
        mkdir($destination.'/'.$info->name());
        
        # Act:
        $info->moveTo($destination);
    }

    /**
     * @test
     * @expectedException \System\IO\DirectoryNotFoundException
    */
    public function MoveTo_ThrowsExceptionWhenDirectoryWasNotCreated() 
    {
        # Arrange:
        $name = $this->generateName();
        $destination = $this->generateName();
        $info = new DirectoryInfo($name);
        $info->create();
        
        # Act:
        $info->moveTo($destination);
    }

    /**
     * @test
    */
    public function MoveTo_CanMoveDirectoryWithoutChildren() 
    {
        # Arrange:
        $name = $this->generateName();
        $destination = $this->generateName();
        $info = new DirectoryInfo($name);
        mkdir($destination);
        $info->create();
        
        # Act:
        $info->moveTo($destination);

        # Assert:
        $this->assertTrue(file_exists($destination.'/'.$info->name()));

        # Post:
        $info->delete(true);
        rmdir($destination);
    }


    /**
     * @test
    */
    public function MoveTo_CanMoveDirectoryWithChildren() 
    {
        # Arrange:
        $name = $this->generateName();
        $destination = $this->generateName();
        $info = new DirectoryInfo($name);
        mkdir($destination);
        
        for($i = 0; $i < 3; $i++)
        {
            $info->createSubDirectory($i);
        }
        
        # Act:
        $info->moveTo($destination);

        # Assert:
        $this->assertTrue(file_exists($info->fullName().'/0'));

        # Post:
        $info->delete(true);
        rmdir($destination);
    }

    /**
     * @test
    */
    public function Parent_GetParentDirectory() 
    {
        # Arrange:
        $name = $this->generateName();
        $info = new DirectoryInfo($name);
        
        # Act:
        $parent = $info->parent();

        # Assert:
        $this->assertEquals('tmp', $parent->name());
    }


    /**
     * @test
    */
    public function Root_CanGetRootPath() 
    {
        # Arrange:
        $name = $this->generateName();
        $info = new DirectoryInfo($name);
        
        # Act:
        $root = $info->root();

        # Assert:
        $this->assertEquals('tmp', $root->name());
    }
}
