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
    private static string $testFakePath = 'C:\Users\someone\Documents\some directory\\';

    public function testDirectoryExists(): void
    {
        $result = Directory::exists(self::$testFakePath);

        self::assertFalse($result);
    }
}
