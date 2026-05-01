<?php

namespace PhpIoUtils\system\io\directory;

use PhpIoUtils\system\permission\Permissions;

class Directory
{
    public static function exists(string $path): bool
    {
        if (file_exists($path) && !is_dir($path)) {
            return false;
        }

        return is_dir($path);
    }

    public static function create(string $path, int $mode = Permissions::OCT_EVERYONE_FULL, bool $recursive = true): bool
    {
        if (self::exists($path)) {
            return true;
        }

        return mkdir($path, $mode, $recursive);
    }
}
