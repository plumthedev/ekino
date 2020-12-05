<?php

namespace App\Services\MediaGenerator;

use App\Services\MediaGenerator\Contracts\Service as Contract;
use App\Services\MediaGenerator\Generators\Person as PersonImageGenerator;
use App\Services\MediaGenerator\Generators\Picsum as PicsumImageGenerator;
use App\Services\MediaGenerator\Generators\SolidBackground as SolidBackgroundImageGenerator;
use Illuminate\Config\Repository;

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
	 * @return \App\Services\MediaGenerator\Provider
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
	 * @return \App\Services\MediaGenerator\Provider
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
	 * @return \App\Services\MediaGenerator\Provider
	 */
	public function solidBackground(): Provider
	{
		return new Provider(
			$this->config,
			new SolidBackgroundImageGenerator($this->config)
		);
	}
}
