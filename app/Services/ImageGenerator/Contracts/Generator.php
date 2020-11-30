<?php


namespace App\Services\ImageGenerator\Contracts;


interface Generator
{
	/**
	 * Set image blur.
	 *
	 * @param int $amount
	 *
	 * @return \App\Services\ImageGenerator\Contracts\Generator
	 */
	public function blur(int $amount = 1): Generator;

	/**
	 * Get image by id.
	 *
	 * @param int $id
	 *
	 * @return \App\Services\ImageGenerator\Contracts\Generator
	 */
	public function byId(int $id): Generator;

	/**
	 * Get image by seed.
	 *
	 * @param string $seed
	 *
	 * @return \App\Services\ImageGenerator\Contracts\Generator
	 */
	public function bySeed(string $seed): Generator;

	/**
	 * Get generated image.
	 *
	 * @param int|null $width
	 * @param int|null $height
	 *
	 * @return string
	 */
	public function getUrl(?int $width = null, ?int $height = null): string;

	/**
	 * Set image grayscale.
	 *
	 * @return \App\Services\ImageGenerator\Contracts\Generator
	 */
	public function grayscale(): Generator;

	/**
	 * Set image format.
	 *
	 * @param int $format
	 *
	 * @return \App\Services\ImageGenerator\Contracts\Generator
	 */
	public function setFormat(int $format): Generator;

	/**
	 * Set image height.
	 *
	 * @param int $height
	 *
	 * @return \App\Services\ImageGenerator\Contracts\Generator
	 */
	public function setHeight(int $height): Generator;

	/**
	 * Make image square.
	 * Set square by side length.
	 *
	 * @param int $sideLength
	 *
	 * @return \App\Services\ImageGenerator\Contracts\Generator
	 */
	public function setSquare(int $sideLength): Generator;

	/**
	 * Set image width.
	 *
	 * @param int $width
	 *
	 * @return \App\Services\ImageGenerator\Contracts\Generator
	 */
	public function setWidth(int $width): Generator;
}
