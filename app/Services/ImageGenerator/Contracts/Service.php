<?php

namespace App\Services\ImageGenerator\Contracts;

use App\Services\ImageGenerator\Provider;

/**
 * Image generator service contract.
 *
 * @author Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
interface Service
{
	/**
	 * Person image provider.
	 *
	 * @return \App\Services\ImageGenerator\Provider
	 */
	public function person(): Provider;

	/**
	 * Picsum image provider.
	 *
	 * @return \App\Services\ImageGenerator\Provider
	 */
	public function picsum(): Provider;

	/**
	 * Solid background image generator.
	 *
	 * @return \App\Services\ImageGenerator\Provider
	 */
	public function solidBackground(): Provider;
}
