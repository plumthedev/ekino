<?php


namespace App\Services\ImageGenerator;

use App\Services\ImageGenerator\Contracts\Generator as Contract;
use Illuminate\Config\Repository;
use InvalidArgumentException;


class Generator implements Contract
{
	/**
	 * Http Query parameter - grayscale.
	 *
	 * @var string
	 */
	const GRAYSCALE_QUERY_PARAMETER_NAME = 'grayscale';

	/**
	 * Http Query parameter - blur.
	 *
	 * @var string
	 */
	const BLUR_QUERY_PARAMETER_NAME = 'blur';

	/**
	 * LoremPicsum base url.
	 *
	 * @var string
	 */
	protected $baseUrl = 'https://picsum.photos';


	/**
	 * Blur value.
	 *
	 * @var null|int
	 */
	protected $blur = null;

	/**
	 * Generator configuration repository.
	 *
	 * @var \Illuminate\Config\Repository
	 */
	protected $config;

	/**
	 * @var null|string
	 */
	protected $format = null;

	/**
	 * Is used grayscale.
	 *
	 * @var bool
	 */
	protected $grayscale = false;

	/**
	 * Image height.
	 *
	 * @var int
	 */
	protected $height = 1080;

	/**
	 * Used image id.
	 *
	 * @var null|int
	 */
	protected $id = null;

	/**
	 * Image LoremPicsum base url.
	 *
	 * @var string
	 */
	protected $imageUrl = '';

	/**
	 * Used image seed.
	 *
	 * @var null|int
	 */
	protected $seed = null;

	/**
	 * Image width.
	 *
	 * @var int
	 */
	protected $width = 1920;

	/**
	 * LoremPicsum Image Generator.
	 *
	 * @param \Illuminate\Config\Repository $config
	 */
	public function __construct(Repository $config)
	{
		$this->config = $config;
	}

	/**
	 * Set image blur.
	 *
	 * @param int $amount
	 *
	 * @return \App\Services\ImageGenerator\Contracts\Generator
	 */
	public function blur(int $amount = 1): Contract
	{
		if ($amount < 0) {
			$amount = 0;
		}

		if ($amount > 10) {
			$amount = 10;
		}

		$this->blur = $amount;
		return $this;
	}

	/**
	 * Get image by id.
	 *
	 * @param int $id
	 *
	 * @return \App\Services\ImageGenerator\Contracts\Generator
	 */
	public function byId(int $id): Contract
	{
		$this->seed = null;
		$this->id = $id;

		return $this;
	}

	/**
	 * Get image by seed.
	 *
	 * @param string $seed
	 *
	 * @return \App\Services\ImageGenerator\Contracts\Generator
	 */
	public function bySeed(string $seed): Contract
	{
		$this->id = null;
		$this->seed = $seed;

		return $this;
	}

	/**
	 * Get generated image.
	 *
	 * @param int|null $width
	 * @param int|null $height
	 *
	 * @return string
	 */
	public function getUrl(?int $width = null, ?int $height = null): string
	{
		if ($width) {
			$this->setWidth($width);
		}

		if ($height) {
			$this->setHeight($height);
		}

		return $this->buildImageUrl();
	}

	/**
	 * Set image grayscale.
	 *
	 * @return \App\Services\ImageGenerator\Contracts\Generator
	 */
	public function grayscale(): Contract
	{
		$this->grayscale = true;
		return $this;
	}

	/**
	 * Set image format.
	 *
	 * @param int $format
	 *
	 * @return \App\Services\ImageGenerator\Contracts\Generator
	 */
	public function setFormat(int $format): Contract
	{
		if (!in_array($format, $this->config->get('format.allowed', []))) {
			throw new InvalidArgumentException(
				sprintf('Not allowed format provided [%s].', $format)
			);
		}

		$this->format = $format;
		return $this;
	}

	/**
	 * Set image height.
	 *
	 * @param int $height
	 *
	 * @return \App\Services\ImageGenerator\Contracts\Generator
	 */
	public function setHeight(int $height): Contract
	{
		$minimumHeight = $this->config->get('sizes.height.minimum', 8);
		$defaultHeight = $this->config->get('sizes.height.default', 64);

		if ($height < $minimumHeight) {
			$height = $defaultHeight;
		}

		$this->height = $height;
		return $this;
	}

	/**
	 * Make image square.
	 * Set square by side length.
	 *
	 * @param int $sideLength
	 *
	 * @return \App\Services\ImageGenerator\Contracts\Generator
	 */
	public function setSquare(int $sideLength): Contract
	{
		$this->setHeight($sideLength);
		$this->setWidth($sideLength);

		return $this;
	}

	/**
	 * Set image width.
	 *
	 * @param int $width
	 *
	 * @return \App\Services\ImageGenerator\Contracts\Generator
	 */
	public function setWidth(int $width): Contract
	{
		$minimumWidth = $this->config->get('sizes.width.minimum', 8);
		$defaultWidth = $this->config->get('sizes.width.default', 64);

		if ($width < $minimumWidth) {
			$width = $defaultWidth;
		}

		$this->width = $width;
		return $this;
	}

	/**
	 * Build image url based on chosen user options.
	 *
	 * @return string
	 */
	protected function buildImageUrl(): string
	{
		$this->imageUrl = $this->baseUrl;

		$this->composeImageUrlBase();
		$this->composeImageUrlSize();
		$this->composeImageUrlFormat();
		$this->composeImageUrlQuery();

		return $this->imageUrl;
	}


	/**
	 * Compose image url base.
	 *
	 * @return void
	 */
	protected function composeImageUrlBase(): void
	{
		if ($this->id) {
			$this->imageUrl = $this->baseUrl;
			$this->imageUrl = "{$this->imageUrl}/id/{$this->id}";
		}

		if ($this->seed) {
			$this->imageUrl = $this->baseUrl;
			$this->imageUrl = "{$this->imageUrl}/seed/{$this->seed}";
		}
	}

	/**
	 * Compose image url format.
	 *
	 * @return void
	 */
	protected function composeImageUrlFormat(): void
	{
		if ($this->format) {
			$this->imageUrl = "{$this->imageUrl}.{$this->format}";
		}
	}


	/**
	 * Compose image url size.
	 *
	 * @return void
	 */
	protected function composeImageUrlSize(): void
	{
		$this->imageUrl = "{$this->imageUrl}/{$this->width}/{$this->height}";
	}


	/**
	 * Compose image url query.
	 *
	 * @return void
	 */
	protected function composeImageUrlQuery(): void
	{
		$queryParams = [
			'random' => mt_rand(1, 100000)
		];

		if ($this->grayscale) {
			$queryParams[self::GRAYSCALE_QUERY_PARAMETER_NAME] = $this->grayscale;
		}

		if ($this->blur) {
			$queryParams[self::BLUR_QUERY_PARAMETER_NAME] = $this->blur;
		}

		$query = http_build_query($queryParams);

		if (!empty($query)) {
			$this->imageUrl = "{$this->imageUrl}/?{$query}";
		}
	}
}
