<?php

namespace App\Services\MediaGenerator\Contracts;

use Illuminate\Http\UploadedFile;

/**
 * Image generator contract.
 *
 * @author Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
interface Generator
{
	/**
	 * Create image based on size.
	 *
	 * @param int $width
	 * @param int $height
	 *
	 * @return \Illuminate\Http\UploadedFile
	 */
	public function createImage(int $width, int $height): UploadedFile;
}
