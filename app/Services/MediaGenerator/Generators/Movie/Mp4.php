<?php

namespace App\Services\MediaGenerator\Generators\Movie;

use Illuminate\Config\Repository;
use Illuminate\Http\UploadedFile;

use App\Services\MediaGenerator\AbstractGenerator;
use App\Services\MediaGenerator\Contracts\Assets;

/**
 * MP4 movie generator.
 *
 * @author  Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
class Mp4 extends AbstractGenerator
{
    /**
     * Media generator assets.
     *
     * @var \App\Services\MediaGenerator\Assets
     */
    protected $assets;

    /**
     * Mp4 generator constructor.
     *
     * @param \Illuminate\Config\Repository                 $config
     * @param \App\Services\MediaGenerator\Contracts\Assets $assets
     */
    public function __construct(Repository $config, Assets $assets)
    {
        parent::__construct($config);
        $this->assets = $assets;
    }

    /**
     * Create movie.
     *
     * @param int $width
     * @param int $height
     *
     * @return \Illuminate\Http\UploadedFile
     */
    public function create(int $width, int $height): UploadedFile
    {
        $moviePath = $this->assets->random('/mp4');
        $filename = $this->generateFilename('mp4');
        $filepath = $this->downloadToTempDirectory($filename, $moviePath);

        return new UploadedFile(
            $filepath,
            $filename
        );
    }
}
