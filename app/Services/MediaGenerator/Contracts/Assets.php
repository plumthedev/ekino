<?php

namespace App\Services\MediaGenerator\Contracts;

/**
 * Media generator assets.
 *
 * @author Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
interface Assets
{
    /**
     * Get all assets paths by path.
     *
     * @param string $path
     * @param bool   $recursive
     *
     * @return array
     */
    public function all(string $path = '', bool $recursive = true): array;

    /**
     * Get random asset path by path.
     *
     * @param string $path
     * @param bool   $recursive
     *
     * @return string
     */
    public function random(string $path = '', $recursive = true): string;
}
