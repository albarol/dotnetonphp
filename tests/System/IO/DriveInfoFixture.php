<?php

require_once dirname(__FILE__) . '/../../../src/Autoloader.php';

use \System\IO\DriveInfo as DriveInfo;
use \System\IO\DirectoryInfo as DirectoryInfo;

class DriveInfoTest extends PHPUnit_Framework_TestCase
{
    public function test_AvailableFreeSpace_CanGetFreeSpace() {
        $driver = new DriveInfo();
        $this->assertGreaterThan(0, $driver->availableFreeSpace());
    }

    public function test_TotalSize_CanGetTotalSize() {
        $driver = new DriveInfo();
        $this->assertGreaterThan(0, $driver->totalSize());
    }

    public function test_RootDirectory_CanGetRootDirectory() {
        $driver = new DriveInfo();
        $rootDirectory = $driver->rootDirectory();
        $this->assertTrue($rootDirectory instanceof DirectoryInfo);
    }
}
?>
