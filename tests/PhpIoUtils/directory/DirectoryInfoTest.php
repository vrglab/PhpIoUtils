<?php

namespace PhpIoUtils\Tests\PhpIoUtils\directory;

use PhpIoUtils\system\io\directory\DirectoryInfo;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(DirectoryInfo::class)]
class DirectoryInfoTest extends TestCase
{
    private static string $testFakePath = 'C:\Users\someone\Documents\some directory\\';

    public function testCreateDirInfo(): void
    {
        $dirInf = new DirectoryInfo(self::$testFakePath);

        self::assertTrue(true);
    }
}
