<?php

namespace App\Providers;

use Illuminate\Config\Repository;
use Illuminate\Support\ServiceProvider;

use App\Services\ImageGenerator\Service as ImageGeneratorService;
use App\Services\ImageGenerator\Contracts\Service as ImageGeneratorServiceContract;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->includeHelpers();
		$this->bindImageGenerator();
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Include helpers to application.
	 *
	 * @return void
	 */
	protected function includeHelpers(): void
	{
		$helpers = app_path('Support/helpers.php');

		if (file_exists($helpers)) {
			require_once $helpers;
		}
	}


	/**
	 * Bind instance of image generator in system.
	 *
	 * @return void
	 */
	protected function bindImageGenerator(): void
	{
		$this->app->bind(ImageGeneratorServiceContract::class, function () {
			return new ImageGeneratorService(
				new Repository(
					config('image_generator')
				)
			);
		});

		$this->app->bind(ImageGeneratorService::class, function () {
			return new ImageGeneratorService(
				new Repository(
					config('image_generator')
				)
			);
		});
	}
}
