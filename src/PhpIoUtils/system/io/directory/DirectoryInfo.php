<?php

namespace PhpIoUtils\system\io\directory;

use DateTime;
use Override;
use PhpIoUtils\system\io\FileSystemInfo;

class DirectoryInfo extends FileSystemInfo
{
    public function __construct(string $path)
    {

        $fullPath = $this->findFullPath($path);
        parent::__construct($fullPath, $path);

        $this->creationTime = $this->figureOutTime('c');
        $this->modifiedTime = $this->figureOutTime('');
    }

    #[Override]
    public function getExtension(): string
    {
        return '';
    }

    #[Override]
    public function getName(): string
    {
        return pathinfo($this->fullPath ?? '', PATHINFO_FILENAME);
    }

    #[Override]
    public function getFullName(): string
    {
        return basename($this->fullPath ?? '');
    }

    #[Override]
    public function Exist(): bool
    {
        return Directory::exists($this->fullPath ?? '');
    }

    private function findFullPath(string $path): string
    {
        $normalizedPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);

        if (
            str_starts_with($normalizedPath, DIRECTORY_SEPARATOR) // Linux/macOS
            || preg_match('/^[A-Za-z]:\\\/', $normalizedPath)   // Windows
        ) {
            $fullPath = $normalizedPath;
        } else {
            $fullPath = (getcwd() ?: '') . DIRECTORY_SEPARATOR . $normalizedPath;
        }

        $resolved = realpath($fullPath);


        return $resolved ?: $fullPath;
    }

    private function figureOutTime(string $mode): ?DateTime
    {

        if ('c' === $mode) {
            $timeInt = filectime($this->getFullPath());
        } else {
            $timeInt = filemtime($this->getFullPath());
        }


        $date = date('Y-m-d H:i:s', $timeInt ?: 0);

        if (is_numeric($timeInt)) {
            return date_create($date) ?: null;
        }

        return null;
    }
}
