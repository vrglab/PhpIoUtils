<?php

namespace PhpIoUtils\Tests\PhpIoUtils\directory;

use Override;
use PhpIoUtils\system\io\directory\DirectoryInfo;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(DirectoryInfo::class)]
class DirectoryInfoTest extends TestCase
{
    private static string $testFakePath = 'strangedir\some directory';

    private DirectoryInfo $dirInfo;

    #[Override]
    protected function setUp(): void
    {
        $this->dirInfo = new DirectoryInfo(self::$testFakePath);
    }

    public function testFullPath(): void
    {
        $expectedPath = (getcwd() ?: '') . DIRECTORY_SEPARATOR . self::$testFakePath;

        self::assertEquals($expectedPath, $this->dirInfo->getFullPath());
    }

    public function testGivenPath(): void
    {
        self::assertEquals(self::$testFakePath, $this->dirInfo->getGivenPath());
    }
}
