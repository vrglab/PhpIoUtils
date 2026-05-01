<?php

namespace PhpIoUtils\system\io\directory;

use PhpIoUtils\system\io\file\File;
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

    public static function delete(string $path, bool $recursive = false): bool
    {
        if (!self::exists($path)) {
            return true;
        }

        if ($recursive) {
            $items = scandir($path);
            if (false === $items) {
                return false;
            }

            foreach ($items as $item) {
                if ('.' === $item || '..' === $item) {
                    continue;
                }

                $possibleFile = new File($item);

                if (!$possibleFile->DoesExist()) {
                    continue;
                }

                if (!$possibleFile->IsActiveFile()) {
                    self::delete($possibleFile->getFileInfo()->getSafePath());
                }
            }
        }

        return rmdir($path);
    }

    public static function isDirectory(string $path): bool
    {
        return !File::isFile($path);
    }
}
