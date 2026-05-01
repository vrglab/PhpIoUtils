<?php

namespace PhpIoUtils\system\io\file;

use Override;
use PhpIoUtils\system\io\FileSystemInfo;

class FileInfo extends FileSystemInfo
{
    public function __construct(string $path)
    {
        $fullPath = FileSystemInfo::findFullPath($path);
        parent::__construct($fullPath, $path);

        $this->creationTime = FileSystemInfo::figureOutTime($this->getSafePath(), 'c');
        $this->modifiedTime = FileSystemInfo::figureOutTime($this->getSafePath(), '');
    }

    #[Override]
    public function getExtension(): string
    {
        return pathinfo($this->getSafePath(), PATHINFO_EXTENSION);
    }

    #[Override]
    public function getName(): string
    {
        return pathinfo($this->getSafePath(), PATHINFO_FILENAME);
    }

    #[Override]
    public function getFullName(): string
    {
        return basename($this->getSafePath());
    }

    #[Override]
    public function Exist(): bool
    {
        return File::exists($this->getSafePath());
    }
}
