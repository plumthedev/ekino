<?php

namespace App\Services\MediaGenerator;

use Illuminate\Config\Repository;

use App\Services\MediaGenerator\Contracts\Assets;
use App\Services\MediaGenerator\Contracts\Service as Contract;
use App\Services\MediaGenerator\Generators\Image\Person as PersonImageGenerator;
use App\Services\MediaGenerator\Generators\Image\Picsum as PicsumImageGenerator;
use App\Services\MediaGenerator\Generators\Image\SolidBackground as SolidBackgroundImageGenerator;
use App\Services\MediaGenerator\Generators\Movie\Mp4 as Mp4MovieGenerator;

/**
 * Media generator service.
 *
 * @author  Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
class Service implements Contract
{
    /**
     * Media generator assets.
     *
     * @var \App\Services\MediaGenerator\Contracts\Assets
     */
    protected $assets;

    /**
     * Service configuration.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Image generator service.
     *
     * @param \Illuminate\Config\Repository                 $config
     * @param \App\Services\MediaGenerator\Contracts\Assets $assets
     */
    public function __construct(Repository $config, Assets $assets)
    {
        $this->assets = $assets;
        $this->config = $config;
    }

    /**
     * Person image provider.
     *
     * @return \App\Services\MediaGenerator\Provider
     */
    public function personImage(): Provider
    {
        return new Provider(
            $this->config,
            new PersonImageGenerator($this->config)
        );
    }

    /**
     * Picsum image provider.
     *
     * @return \App\Services\MediaGenerator\Provider
     */
    public function picsumImage(): Provider
    {
        return new Provider(
            $this->config,
            new PicsumImageGenerator($this->config)
        );
    }

    /**
     * Solid background image generator provider.
     *
     * @return \App\Services\MediaGenerator\Provider
     */
    public function solidBackgroundImage(): Provider
    {
        return new Provider(
            $this->config,
            new SolidBackgroundImageGenerator($this->config)
        );
    }

    /**
     * MP4 movie generator provider.
     *
     * @return \App\Services\MediaGenerator\Provider
     */
    public function mp4Movie(): Provider
    {
        return new Provider(
            $this->config,
            new Mp4MovieGenerator($this->config, $this->assets)
        );
    }
}
