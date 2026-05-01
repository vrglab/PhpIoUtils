<?php

namespace PhpIoUtils\system\io\file;

use PhpIoUtils\system\io\directory\Directory;
use PhpIoUtils\system\permission\Permissions;

class File
{
    private readonly FileInfo $fileInfo;

    public function __construct(string $path)
    {
        $this->fileInfo = new FileInfo($path);
    }

    public function IsActiveFile(): bool
    {
        return self::isFile($this->fileInfo->getSafePath());
    }

    public function DoesExist(): bool
    {
        return self::exists($this->fileInfo->getSafePath());
    }

    public function getFileInfo(): FileInfo
    {
        return $this->fileInfo;
    }


    // STATICS AND OTHERS


    public static function exists(string $path): bool
    {
        if (!self::isFile($path)) {
            return false;
        }

        return file_exists($path);
    }

    public static function create(string $path, $recursive = false, $mode = Permissions::OCT_EVERYONE_FULL): bool
    {
        if (!self::isFile($path)) {
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
