<?php

namespace PhpIoUtils\system\io\file;

use PhpIoUtils\system\io\directory\Directory;
use PhpIoUtils\system\permission\Permissions;

class File
{
    public static function exists(string $path): bool
    {
        if (!File::isFile($path)) {
            return false;
        }

        return file_exists($path);
    }

    public static function create(string $path, $recursive = false, $mode = Permissions::OCT_EVERYONE_FULL): bool
    {
        if (!File::isFile($path)) {
            return false;
        }

        $dirCheck = Directory::exists(dirname($path));

        if (!$dirCheck && $recursive) {
            Directory::create(dirname($path), $mode);
        } else {
            return false;
        }

        return touch($path);
    }

    public static function isFile(string $path): bool
    {
        return !(str_ends_with($path, DIRECTORY_SEPARATOR) || str_ends_with($path, '/') || str_ends_with($path, '\\'));
    }
}
