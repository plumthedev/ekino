<?php

namespace App\Services\ImageGenerator\Generators;

use App\Services\ImageGenerator\AbstractGenerator;
use Illuminate\Http\UploadedFile;

/**
 * Person image generator.
 *
 * @author Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
class Person extends AbstractGenerator
{
	/**
	 * Person image base URL.
	 *
	 * @see https://thispersondoesnotexist.com/
	 * @var string
	 */
	protected $personImageBaseUrl = 'https://thispersondoesnotexist.com/image';

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
		$filename = $this->generateFilename();
		$imagePath = $this->downloadImageToTempDirectory($filename, $this->personImageBaseUrl);

		return new UploadedFile(
			$imagePath,
			$filename
		);
	}
}
