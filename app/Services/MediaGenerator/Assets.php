<?php


namespace App\Services\MediaGenerator;


use Illuminate\Contracts\Filesystem\Filesystem;
use InvalidArgumentException;
use App\Services\MediaGenerator\Contracts\Assets as Contract;

/**
 * Media generator assets.
 *
 * @author Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
class Assets implements Contract
{
    /**
     * Media generator filesystem.
     *
     * @var \Illuminate\Contracts\Filesystem\Filesystem
     */
    protected $filesystem;

    /**
     * Media generator assets.
     *
     * @param \Illuminate\Contracts\Filesystem\Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Get all assets paths by path.
     *
     * @param string $path
     * @param bool   $recursive
     *
     * @return array
     */
    public function all(string $path = '', bool $recursive = true): array
    {
        $paths = $this->filesystem->files($path, $recursive);

        $paths = collect($paths)->map(function (string $filePath) {
            return $this->filesystem->path($filePath);
        });

        return $paths->toArray();
    }

    /**
     * Get random asset path by path.
     *
     * @param string $path
     * @param bool   $recursive
     *
     * @return string
     */
    public function random(string $path = '', $recursive = true): string
    {
        $randomPath = collect(
            $this->all($path, $recursive)
        )->random();

        if (!is_string($randomPath)) {
            throw new InvalidArgumentException(
                sprintf('Cannot find random path on [%s]', $path)
            );
        }

        return $randomPath;
    }
}
