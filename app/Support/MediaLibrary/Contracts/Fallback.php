<?php


namespace App\Support\MediaLibrary\Contracts;


/**
 * Media fallback interface.
 *
 * @author  Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
interface Fallback
{
    /**
     * Get media fallback directory path.
     *
     * @return string
     */
    public function getDirectoryPath(): string;
}
