<?php

namespace App\Services\ImageGenerator;

use RuntimeException;

use Illuminate\Config\Repository;
use Illuminate\Support\Str;

use App\Services\ImageGenerator\Contracts\Generator as Contract;

/**
 * Abstract image generator.
 *
 * @author Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
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
	 * @return string
	 */
	protected function generateFilename(): string
	{
		$filename = Str::random(
			$this->config->get('image.filename_length', self::FILENAME_LENGTH)
		);

		return sprintf("%s.jpg", $filename);
	}

	/**
	 * Download image by url to temp directory.
	 *
	 * @param string $filename
	 * @param string $imageUrl
	 *
	 * @return string
	 */
	protected function downloadImageToTempDirectory(string $filename, string $imageUrl): string
	{
		$imagePath = $this->generateTempDirectoryPath($filename);
		copy($imageUrl, $imagePath);

		return $imagePath;
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
		$tempDirectoryPath = tempnam(
			sys_get_temp_dir(),
			$filename
		);

		if (empty($tempDirectoryPath)) {
			throw new RuntimeException(
				sprintf('Cannot generate temp name for image.')
			);
		}

		return $tempDirectoryPath;
	}
}
