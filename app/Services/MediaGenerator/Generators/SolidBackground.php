<?php

namespace App\Services\MediaGenerator\Generators;

use App\Services\MediaGenerator\AbstractGenerator;
use App\Services\MediaGenerator\Exceptions\ImageGenerationException;
use Exception;
use Illuminate\Http\UploadedFile;

/**
 * Solid background image generator.
 * Generates image in passed size,
 * with random solid color background.
 *
 * @author Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
class SolidBackground extends AbstractGenerator
{
	/**
	 * Create image based on size.
	 *
	 * @param int $width
	 * @param int $height
	 *
	 * @return \Illuminate\Http\UploadedFile
	 */
	public function createImage(int $width, int $height): UploadedFile
	{
		try {
			$filename = $this->generateFilename();
			$filePath = $this->generateTempDirectoryPath($filename);
			$image = $this->generateImage($width, $height);
			imagejpeg($image, $filePath);

			return new UploadedFile(
				$filePath,
				$filename
			);
		} catch (ImageGenerationException $exception) {
			throw new ImageGenerationException(
				$exception->getMessage()
			);
		} catch (Exception $exception) {
			throw new ImageGenerationException(
				sprintf('Cannot generate image resource.')
			);
		}
	}

	/**
	 * Fill image resource with background.
	 *
	 * @param resource $image
	 * @param int $background
	 *
	 * @return void
	 */
	protected function fillImageBackground($image, int $background): void
	{
		$filled = imagefill($image, 0, 0, $background);

		if (!$filled) {
			throw new ImageGenerationException(
				sprintf('Cannot fill generated image background.')
			);
		}
	}

	/**
	 * Generate image resource.
	 *
	 * @param int $width
	 * @param int $height
	 *
	 * @return resource
	 */
	protected function generateImage(int $width, int $height)
	{
		$image = imagecreatetruecolor($width, $height);

		if (!is_resource($image)) {
			throw new ImageGenerationException(
				sprintf('Cannot generate image resource.')
			);
		}

		$backgroundColor = $this->generateImageBackground($image);
		$this->fillImageBackground($image, $backgroundColor);

		return $image;
	}

	/**
	 * Generate image background color.
	 * Color is generated randomly.
	 *
	 * @param resource $image
	 *
	 * @return int
	 */
	protected function generateImageBackground($image): int
	{
		$color = imagecolorallocate(
			$image,
			mt_rand(0, 255),
			mt_rand(0, 255),
			mt_rand(0, 255),
		);

		if (empty($color)) {
			throw new ImageGenerationException(
				sprintf('Cannot generate image background color.')
			);
		}

		return $color;
	}
}
