<?php

namespace App\Providers;

use Illuminate\Config\Repository;
use Illuminate\Support\ServiceProvider;
use App\Services\ImageGenerator\Generator as ImageGenerator;
use App\Services\ImageGenerator\Contracts\Generator as ImageGeneratorContract;

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
		$this->app->bind(ImageGeneratorContract::class, function () {
			return new ImageGenerator(
				new Repository(
					config('image_generator')
				)
			);
		});
	}
}
