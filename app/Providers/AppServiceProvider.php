<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
}
