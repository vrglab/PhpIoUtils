<?php

namespace io;

class Directory
{
  public static function exists(string $path): bool
  {
    $isDir = is_dir($path);

    if (!$isDir)
      return false;

    return file_exists($path);
  }
}