<?php

namespace App\Services\ImageGenerator;

use Illuminate\Config\Repository;
use Illuminate\Http\UploadedFile;

use App\Services\ImageGenerator\Contracts\Generator;
use App\Services\ImageGenerator\Contracts\Provider as Contract;

/**
 * Abstract image provider.
 * Provide image as uploaded file or path from temp directory.
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
	const IMAGE_WIDTH = 1920;

	/**
	 * Default image height.
	 *
	 * @var int
	 */
	const IMAGE_HEIGHT = 1080;

	/**
	 * Configuration repository.
	 *
	 * @var \Illuminate\Config\Repository
	 */
	protected $config;

	/**
	 * Image generator.
	 *
	 * @var \App\Services\ImageGenerator\Contracts\Generator
	 */
	protected $generator;

	/**
	 * Create new instance of provider.
	 *
	 * @param \Illuminate\Config\Repository                    $config
	 * @param \App\Services\ImageGenerator\Contracts\Generator $generator
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
	public function getImage(?int $width = null, ?int $height = null): UploadedFile
	{
		return $this->generateImage($width, $height);
	}

	/**
	 * Get generated image path in temp directory.
	 *
	 * @param int|null $width
	 * @param int|null $height
	 *
	 * @return string
	 */
	public function getImagePath(?int $width = null, ?int $height = null): string
	{
		$generatedImage = $this->generateImage($width, $height);
		return $generatedImage->getRealPath();
	}

	/**
	 * Generate image.
	 *
	 * @param int|null $width
	 * @param int|null $height
	 *
	 * @return \Illuminate\Http\UploadedFile
	 */
	protected function generateImage(?int $width = null, ?int $height = null): UploadedFile
	{
		list($width, $height) = $this->getImageSize($width, $height);
		return $this->generator->createImage($width, $height);
	}

	/**
	 * Get image size by passed values.
	 *
	 * @param int|null $width
	 * @param int|null $height
	 *
	 * @return int[]
	 */
	protected function getImageSize(?int $width, ?int $height): array
	{
		$size = [
			'width'  => $width ?? $this->config->get('image.width', self::IMAGE_WIDTH),
			'height' => $height ?? $this->config->get('image.height', self::IMAGE_HEIGHT),
		];

		return array_values($size);
	}
}
