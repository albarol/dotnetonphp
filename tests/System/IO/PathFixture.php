<?php

require_once dirname(__FILE__) . '/../../../src/Autoloader.php';

use \System\IO\Path as Path;

class PathFixture extends PHPUnit_Framework_TestCase {

    protected $resources;

    public function setUp() {
        $this->resources = array(
            'file' => dirname(__FILE__) . "/../../resources/system.io.Path.txt",
            'path' => dirname(__FILE__) . "/../../resources/"
        );
    }

    public function test_ChangeExtension_ThrowsExceptionWhenPathContainsInvalidChar() {
        $this->setExpectedException("\\System\\ArgumentException");
        Path::changeExtension($this->resources['file'].">", "php");
    }

    public function test_ChangeExtension_ShouldBeEmptyIfPathIsEmpty() {
        $result = Path::changeExtension("", "php");
        $this->assertEquals("", $result);
    }

    public function test_ChangeExtension_ShouldRemoveExtensionWhenParameterExtensionIsNull() {
        $result = Path::changeExtension($this->resources['file'], null);
        $this->assertEquals("system.io.Path", $result);
    }

    public function test_ChangeExtension_ShouldChangeTheExtension() {
        $result = Path::changeExtension($this->resources['file'], "php");
        $this->assertEquals("system.io.Path.php", $result);
    }

    public function test_Combine_ThrowsExceptionWhenPathOneContainsInvalidChar() {
        $this->setExpectedException("\\System\\ArgumentException");
        Path::combine($this->resources['file'].">", "");
    }

    public function test_Combine_ThrowsExceptionWhenPathTwoContainsInvalidChar() {
        $this->setExpectedException("\\System\\ArgumentException");
        Path::combine("", $this->resources['file'].">");
    }

    public function test_Combine_ThrowsExceptionWhenPathOneIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        Path::combine(null, $this->resources['file']);
    }

    public function test_Combine_ThrowsExceptionWhenPathTwoIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        Path::combine($this->resources['file'], null);
    }

    public function test_Combine_ResultShouldBePathTwoWhenIsAbsolutePath() {
        $path = Path::combine($this->resources['file'], realpath($this->resources['file']));
        $this->assertEquals(realpath($this->resources['file']), $path);
    }

    public function test_Combine_CanCombinePaths() {
        $path = Path::combine("C:\\combinePath\\", "pathTwo");
        $this->assertEquals("C:\\combinePath\\pathTwo", $path);
    }

    public function test_GetDirectoryName_ThrowsExceptionWhenPathContainsInvalidChar() {
        $this->setExpectedException("\\System\\ArgumentException");
        Path::getDirectoryName("*");
    }

    public function test_GetDirectoryName_ThrowsExceptionWhenPathIsLong() {
        $this->setExpectedException("\\System\\IO\\PathTooLongException");
        Path::getDirectoryName("aokdfaoksdfoaksdfoaksodfkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaosko");
    }

    public function test_GetDirectoryName_ShouldBeNullWhenIsRoot() {
        $name = Path::getDirectoryName("C:");
        $this->assertNull($name);
    }

    public function test_GetDirectoryName_ShouldBeNullWhenPathIsEmpty() {
        $name = Path::getDirectoryName("");
        $this->assertNull($name);
    }

    public function test_GetDirectory_ShouldBeEmptyWhenDirectoryNotExists() {
        $name = Path::getDirectoryName("C:\\combinePath\\pathTwo");
        $this->assertNull($name);
    }

    public function test_GetDirectoryName_CanGetDirectoryName() {
        $name = Path::getDirectoryName(getcwd());
        $this->assertNotEquals("", $name);
    }

    public function test_GetExtension_ThrowsExceptionWhenPathContainsInvalidChar() {
        $this->setExpectedException("\\System\\ArgumentException");
        Path::getExtension("*");
    }

    public function test_GetExtension_ShouldBeEmptyIfPathIsDirectory() {
        $extension = Path::getExtension(getcwd());
        $this->assertEquals("", $extension);
    }

    public function test_GetExtension_ShouldHaveExtensionWhenPathIsFile() {
        $extension = Path::getExtension($this->resources['file']);
        $this->assertEquals("txt", $extension);
    }

    public function test_GetFileName_ThrowsExceptionWhenPathContainsInvalidChar() {
        $this->setExpectedException("\\System\\ArgumentException");
        Path::getFileName("*");
    }

    public function test_GetFileName_ShouldBeEmptyIfPathIsDirectory() {
        $fileName = Path::getFileName(getcwd());
        $this->assertEquals("", $fileName);
    }

    public function test_GetFileName_ShouldHaveExtensionWhenPathIsFile() {
        $fileName = Path::getFileName($this->resources['file']);
        $this->assertEquals("system.io.Path.txt", $fileName);
    }

    public function test_GetFileNameWithoutExtension_ThrowsExceptionWhenPathContainsInvalidChar() {
        $this->setExpectedException("\\System\\ArgumentException");
        Path::getFileNameWithoutExtension("*");
    }

    public function test_GetFileNameWithoutExtension_ShouldBeEmptyIfPathIsDirectory() {
        $fileName = Path::getFileNameWithoutExtension(getcwd());
        $this->assertEquals("", $fileName);
    }

    public function test_GetFileNameWithoutExtension_ShouldHaveExtensionWhenPathIsFile() {
        $fileName = Path::getFileNameWithoutExtension($this->resources['file']);
        $this->assertEquals("system.io.Path", $fileName);
    }

    public function test_GetFullPath_ThrowsExceptionWhenPathContainsInvalidChar() {
        $this->setExpectedException("\\System\\ArgumentException");
        Path::getFullPath("*");
    }

    public function test_GetFullPath_ThrowsExceptionWhenPathIsNull() {
        $this->setExpectedException("\\System\\ArgumentNullException");
        Path::getFullPath(null);
    }

    public function test_GetFullPath_ThrowsExceptionWhenPathIsLong() {
        $this->setExpectedException("\\System\\IO\\PathTooLongException");
        Path::getFullPath("aokdfaoksdfoaksdfoaksodfkaodskfaosdkfoasdkfoaksdfoaksdofkaosdfkaosdfkaosdkfaosdfkoaksdfoaksdofkasodfkaoskdfoasdkfoaksdfoaksdfokasdofkasodfkaosdfkaosdfkaoksdfoaskdfoaksdfoaksdfoaksdfokasodfkaosdfkaosdfkoasdkfoasdkfoasdfkoasdkfoaskdfoaskdfoaksdfoaosko");
    }

    public function test_GetFullPath_CanGetFullPath() {
        $fullPath = Path::getFullPath($this->resources['path']);
        $this->assertNotNull($fullPath);
    }

    public function test_GetInvalidFileNameChars_CanGetInvalidFileNameChars() {
        $invalidChars = Path::getInvalidPathChars();
        $this->assertEquals(5, sizeof($invalidChars));
    }

    public function test_GetInvalidPathChars_CanGetInvalidPathChars() {
        $invalidChars = Path::getInvalidPathChars();
        $this->assertEquals(5, sizeof($invalidChars));
    }

    public function test_GetPathRoot_ThrowsExceptionWhenPathContainsInvalidChar() {
        $this->setExpectedException("\\System\\ArgumentException");
        Path::getPathRoot("*");
    }

    public function test_GetPathRoot_ThrowsExceptionWhenPathIsNull() {
        $this->setExpectedException("\\System\\ArgumentException");
        Path::getPathRoot("");
    }

    public function test_GetPathRoot_CanGetRootFromPath() {
        $root = Path::getPathRoot($this->resources['path']);
        $this->assertNotNull($root);
    }

    public function test_GetRandomFileName_CanGetRandomFileName() {
        $fileNameOne = Path::getRandomFileName();
        $fileNameTwo = Path::getRandomFileName();
        $this->assertNotEquals($fileNameOne, $fileNameTwo);
    }

    public function test_GetTempFileName_CanGetTempFileName() {
        $fileName = Path::getTempFileName();
        $this->assertFileExists($fileName);
    }

    public function test_HetTempPath_CanGetTempPath() {
        $path = Path::getTempPath();
        $this->assertNotNull($path);
    }

    public function test_HasExtension_ThrowsExceptionWhenPathContainsInvalidChar() {
        $this->setExpectedException("\\System\\ArgumentException");
        Path::hasExtension("*");
    }

    public function test_HasExtension_ShouldBeFalseWhenPathNotContainsExtension() {
        $hasExtension = Path::hasExtension($this->resources['path']);
        $this->assertFalse($hasExtension);
    }

    public function test_HasExtension_ShouldBeTrueWhenPathContainsExtension() {
        $hasExtension = Path::hasExtension($this->resources['file']);
        $this->assertTrue($hasExtension);
    }

    public function test_IsPathRooted_ThrowsExceptionWhenPathContainsInvalidChar() {
        $this->setExpectedException("\\System\\ArgumentException");
        Path::isPathRooted("*");
    }

    public function test_IsPathRooted_ShouldBeTrueIfPathIsAbsolute() {
        $isPathRooted = Path::isPathRooted(realpath($this->resources['path']));
        $this->assertTrue($isPathRooted);
    }

    public function test_IsPathRooted_ShouldBeFalseIfPathIsRelative() {
        $isPathRooted = Path::isPathRooted('../system/');
        $this->assertFalse($isPathRooted);
    }
}
?>
