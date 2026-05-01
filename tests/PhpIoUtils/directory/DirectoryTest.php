<?php

namespace PhpIoUtils\Tests\PhpIoUtils\directory;

use PhpIoUtils\system\io\directory\Directory;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversClass(Directory::class)]
class DirectoryTest extends TestCase
{
    private static string $testFakePath = '\strangedir\some directory';

    public function testDirectoryExists(): void
    {
        $result = Directory::exists(self::$testFakePath);

        self::assertFalse($result);
    }

    public function testDirectoryCreate(): void
    {
        $result = Directory::create(self::$testFakePath);

        self::assertTrue($result);
    }

    public function testDirectoryDelete(): void
    {
        $result = Directory::delete(self::$testFakePath, true);

        self::assertTrue($result);
    }
}
