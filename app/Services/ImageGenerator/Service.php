<?php

namespace App\Services\ImageGenerator;

use Illuminate\Config\Repository;

use App\Services\ImageGenerator\Contracts\Service as Contract;

use App\Services\ImageGenerator\Generators\SolidBackground as SolidBackgroundImageGenerator;
use App\Services\ImageGenerator\Generators\Person as PersonImageGenerator;
use App\Services\ImageGenerator\Generators\Picsum as PicsumImageGenerator;

/**
 * Image generator service.
 *
 * @author Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
class Service implements Contract
{
	/**
	 * Service configuration.
	 *
	 * @var \Illuminate\Config\Repository
	 */
	protected $config;

	/**
	 * Image generator service.
	 *
	 * @param \Illuminate\Config\Repository $config
	 */
	public function __construct(Repository $config)
	{
		$this->config = $config;
	}

	/**
	 * Person image provider.
	 *
	 * @return \App\Services\ImageGenerator\Provider
	 */
	public function person(): Provider
	{
		return new Provider(
			$this->config,
			new PersonImageGenerator($this->config)
		);
	}

	/**
	 * Picsum image provider.
	 *
	 * @return \App\Services\ImageGenerator\Provider
	 */
	public function picsum(): Provider
	{
		return new Provider(
			$this->config,
			new PicsumImageGenerator($this->config)
		);
	}

	/**
	 * Solid background image generator.
	 *
	 * @return \App\Services\ImageGenerator\Provider
	 */
	public function solidBackground(): Provider
	{
		return new Provider(
			$this->config,
			new SolidBackgroundImageGenerator($this->config)
		);
	}
}
