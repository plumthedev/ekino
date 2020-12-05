<?php

namespace App\Services\MediaGenerator;

use App\Services\MediaGenerator\Contracts\Generator as Contract;
use Illuminate\Config\Repository;
use Illuminate\Support\Str;
use RuntimeException;

/**
 * Abstract media generator.
 *
 * @author  Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
abstract class AbstractGenerator implements Contract
{
    /**
     * Default image filename length.
     *
     * @var int
     */
    const FILENAME_LENGTH = 32;

    /**
     * Configuration repository.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Create new instance of provider.
     *
     * @param \Illuminate\Config\Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Generate image filename.
     *
     * @param string $extension
     *
     * @return string
     */
    protected function generateFilename(string $extension): string
    {
        $filename = Str::random(
            $this->config->get('media.filename_length', self::FILENAME_LENGTH)
        );

        return sprintf("%s.%s", $filename, $extension);
    }

    /**
     * Download image by url to temp directory.
     *
     * @param string $filename
     * @param string $mediaUrl
     *
     * @return string
     */
    protected function downloadToTempDirectory(string $filename, string $mediaUrl): string
    {
        $path = $this->generateTempDirectoryPath($filename);
        $contents = file_get_contents($mediaUrl);
        $media = fopen($path, 'w+');

        fwrite($media, $contents);

        return $path;
    }

    /**
     * Generate temp directory path.
     *
     * @param string $filename
     *
     * @return string
     */
    protected function generateTempDirectoryPath(string $filename): string
    {
        $tempDirectoryPath = sys_get_temp_dir();
        $tempDirectoryPath = "{$tempDirectoryPath}/{$filename}";

        if (empty($tempDirectoryPath)) {
            throw new RuntimeException(
                sprintf('Cannot generate temp name for image.')
            );
        }

        return $tempDirectoryPath;
    }
}
