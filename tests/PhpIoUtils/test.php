<?php

namespace PhpIoUtils;

use PhpIoUtils\Directory;

class test
{
    public static function dirExists(string $path): bool
    {
        return Directory::exists($path);
    }
}
