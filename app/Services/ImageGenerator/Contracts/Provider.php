<?php

namespace App\Services\ImageGenerator\Contracts;

use Illuminate\Http\UploadedFile;

/**
 * Image provider contract.
 * Provide image as uploaded file or path from temp directory.
 *
 * @author Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
interface Provider
{
	/**
	 * Get generated image as uploaded file instance.
	 *
	 * @param int|null $width
	 * @param int|null $height
	 *
	 * @return \Illuminate\Http\UploadedFile
	 */
	public function getImage(?int $width = null, ?int $height = null): UploadedFile;

	/**
	 * Get generated image path in temp directory.
	 *
	 * @param int|null $width
	 * @param int|null $height
	 *
	 * @return string
	 */
	public function getImagePath(?int $width = null, ?int $height = null): string;
}
