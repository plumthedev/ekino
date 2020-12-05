<?php

namespace App\Services\MediaGenerator;

use App\Services\MediaGenerator\Contracts\Generator;
use App\Services\MediaGenerator\Contracts\Provider as Contract;
use Illuminate\Config\Repository;
use Illuminate\Http\UploadedFile;

/**
 * Media provider.
 * Provide media as uploaded file by type.
 *
 * @author Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
class Provider implements Contract
{
	/**
	 * Default image width.
	 *
	 * @var int
	 */
	const MEDIA_WIDTH = 1920;

	/**
	 * Default image height.
	 *
	 * @var int
	 */
	const MEDIA_HEIGHT = 1080;

	/**
	 * Configuration repository.
	 *
	 * @var \Illuminate\Config\Repository
	 */
	protected $config;

	/**
	 * Image generator.
	 *
	 * @var \App\Services\MediaGenerator\Contracts\Generator
	 */
	protected $generator;

	/**
	 * Create new instance of provider.
	 *
	 * @param \Illuminate\Config\Repository                    $config
	 * @param \App\Services\MediaGenerator\Contracts\Generator $generator
	 */
	public function __construct(Repository $config, Generator $generator)
	{
		$this->config = $config;
		$this->generator = $generator;
	}

	/**
	 * Get generated image as uploaded file instance.
	 *
	 * @param int|null $width
	 * @param int|null $height
	 *
	 * @return \Illuminate\Http\UploadedFile
	 */
	public function getMedia(?int $width = null, ?int $height = null): UploadedFile
	{
		return $this->generateMedia($width, $height);
	}

	/**
	 * Get generated image path in temp directory.
	 *
	 * @param int|null $width
	 * @param int|null $height
	 *
	 * @return string
	 */
	public function getMediaPath(?int $width = null, ?int $height = null): string
	{
		return $this->getMedia($width, $height)->getRealPath();
	}

	/**
	 * Generate image.
	 *
	 * @param int|null $width
	 * @param int|null $height
	 *
	 * @return \Illuminate\Http\UploadedFile
	 */
	protected function generateMedia(?int $width = null, ?int $height = null): UploadedFile
	{
		[$width, $height] = $this->composeMediaSize($width, $height);
		return $this->generator->create($width, $height);
	}

	/**
	 * Get image size by passed values.
	 *
	 * @param int|null $width
	 * @param int|null $height
	 *
	 * @return int[]
	 */
	protected function composeMediaSize(?int $width, ?int $height): array
	{
		$size = [
            'width'  => $width ?? $this->config->get('media.width', self::MEDIA_WIDTH),
            'height' => $height ?? $this->config->get('media.height', self::MEDIA_HEIGHT),
		];

		return array_values($size);
	}
}
