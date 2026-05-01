<?php

namespace PhpIoUtils\system\io;

use DateTime;
use UnexpectedValueException;

abstract class FileSystemInfo
{
    protected ?string $fullPath = null;
    protected ?string $givenPath = null;

    protected ?DateTime $creationTime = null;
    protected ?DateTime $modifiedTime = null;

    /**
     * @param null|string $fullPath  found complete path to the directory or file
     * @param null|string $givenPath given path by the user
     */
    public function __construct(?string $fullPath, ?string $givenPath)
    {
        $this->fullPath = $fullPath;
        $this->givenPath = $givenPath;
    }

    public function __toString(): string
    {
        return $this->givenPath ?? '';
    }

    public function getFullPath(): string
    {
        return $this->fullPath ?? '';
    }

    public function getGivenPath(): string
    {
        return $this->givenPath ?? '';
    }

    public function getCreationTime(): DateTime
    {
        if (null === $this->creationTime) {
            throw new UnexpectedValueException('No creation time found');
        }

        return $this->creationTime;
    }

    public function getModifiedTime(): DateTime
    {
        if (null === $this->modifiedTime) {
            throw new UnexpectedValueException('No modification time found');
        }

        return $this->modifiedTime;
    }

    /**
     * Get's the extension of the file or nothing when called on from a Directory.
     *
     * @return string the found extension
     */
    abstract public function getExtension(): string;

    /**
     * Get's the name of the file or directory without the extension.
     *
     * @return string The name of the File or Directory
     */
    abstract public function getName(): string;

    /**
     * Get's the name of the file or directory with the extension.
     *
     * @return string The name of the File or Directory
     */
    abstract public function getFullName(): string;

    abstract public function Exist(): bool;
}
