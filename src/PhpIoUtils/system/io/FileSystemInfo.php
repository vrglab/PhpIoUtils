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

    protected static function findFullPath(string $path): string
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

    protected static function figureOutTime(string $path, string $mode): ?DateTime
    {

        if ('c' === $mode) {
            $timeInt = filectime($path);
        } else {
            $timeInt = filemtime($path);
        }


        $date = date('Y-m-d H:i:s', $timeInt ?: 0);

        if (is_numeric($timeInt)) {
            return date_create($date) ?: null;
        }

        return null;
    }

    public function getSafePath(): string
    {
        return $this->fullPath ?? $this->givenPath ?? '';
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
