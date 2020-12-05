<?php

namespace App\Services\MediaGenerator\Generators\Image;

use App\Services\MediaGenerator\AbstractGenerator;
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
	public function create(int $width, int $height): UploadedFile
	{
		$filename = $this->generateFilename('jpg');
		$imagePath = $this->downloadToTempDirectory($filename, $this->personImageBaseUrl);

		return new UploadedFile(
			$imagePath,
			$filename
		);
	}
}
