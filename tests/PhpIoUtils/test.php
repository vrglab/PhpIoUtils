<?php


namespace PhpIoUtils;
use io\Directory;

class test
{
  public static function dirExists(string $path): bool
  {
    return Directory::exists($path);
  }
}