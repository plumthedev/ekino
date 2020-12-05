<?php

namespace App\Services\MediaGenerator\Contracts;

use App\Services\MediaGenerator\Provider;

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
	 * @return \App\Services\MediaGenerator\Provider
	 */
	public function person(): Provider;

	/**
	 * Picsum image provider.
	 *
	 * @return \App\Services\MediaGenerator\Provider
	 */
	public function picsum(): Provider;

	/**
	 * Solid background image generator.
	 *
	 * @return \App\Services\MediaGenerator\Provider
	 */
	public function solidBackground(): Provider;
}
