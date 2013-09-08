<?php

use \System\IO\DriveInfo as DriveInfo;
use \System\IO\DriveType as DriveType;
use \System\IO\DirectoryInfo as DirectoryInfo;

/**
 * @group io
*/
class DriveInfoTestCase extends PHPUnit_Framework_TestCase {

    /**
     * @test
    */
    public function AvailableFreeSpace_CanGetFreeSpace() {

        # Arrange:
        $drive = new DriveInfo();

        # Assert:
        $this->assertGreaterThan(0, $drive->availableFreeSpace());
    }

    /**
     * @test
    */
    public function TotalSize_CanGetTotalSize() {

        # Arrange:
        $drive = new DriveInfo();

        # Assert:
        $this->assertGreaterThan(0, $drive->totalSize());
    }

    /**
     * @test
    */
    public function RootDirectory_CanGetRootDirectory() {

        # Arrange:
        $drive = new DriveInfo();
        
        # Act:
        $rootDirectory = $drive->rootDirectory();
        
        # Assert:
        $this->assertTrue($rootDirectory instanceof DirectoryInfo);
    }

    /**
     * @test
    */
    public function DriveType_CanGetDriveType() {
    
        # Arrange:
        $drive = new DriveInfo;
    
        # Act:
        $driveType = $drive->driveType();
    
        # Assert:
        $this->assertEquals($driveType, DriveType::unknown());
    }
}
