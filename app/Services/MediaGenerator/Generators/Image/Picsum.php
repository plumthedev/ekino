<?php

namespace App\Services\MediaGenerator\Generators\Image;

use App\Services\MediaGenerator\AbstractGenerator;
use Illuminate\Http\UploadedFile;

/**
 * Lorem Picsum image generator.
 *
 * @author Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
class Picsum extends AbstractGenerator
{
	/**
	 * LoremPicsum base URL.
	 *
	 * @see https://picsum.photos/
	 * @var string
	 */
	protected $picsumBaseUrl = 'https://picsum.photos';

	/**
	 * Create image based on size.
	 *
	 * @param int $width
	 * @param int $height
	 *
	 * @return \Illuminate\Http\UploadedFile
	 */
	public function create(int $width, int $height): UploadedFile
	{
		$filename = $this->generateFilename('jpg');
		$imageUrl = $this->composeImageUrl($width, $height);
		$imagePath = $this->downloadToTempDirectory($filename, $imageUrl);

		return new UploadedFile(
			$imagePath,
			$filename
		);
	}

	/**
	 * Compose picsum image url.
	 *
	 * @param int $width
	 * @param int $height
	 *
	 * @return string
	 */
	protected function composeImageUrl(int $width, int $height): string
	{
		return sprintf("%s/%s/%s/", $this->picsumBaseUrl, $width, $height);
	}
}
