<?php

namespace PhpIoUtils;

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

        if (!$dirCheck && !$recursive) {
            return false;
        }

        if (!$dirCheck && $recursive) {
            Directory::create(dirname($path), $mode);
        }

        return touch($path);
    }

    public static function isFile(string $path): bool
    {
        return !(str_ends_with($path, DIRECTORY_SEPARATOR) || str_ends_with($path, '/') || str_ends_with($path, '\\'));
    }
}
