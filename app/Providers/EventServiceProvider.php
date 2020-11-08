<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
	/**
	 * The event listener mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		Registered::class => [
			SendEmailVerificationNotification::class,
		],
	];

	protected $observers = [
		\App\Models\Rate::class => \App\Observers\RateObserver::class,
	];

	/**
	 * Register any events for your application.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		$this->observeModels();
	}

	/**
	 * Enable models observers.
	 *
	 * @return void
	 */
	protected function observeModels(): void
	{
		foreach ($this->observers as $model => $observer) {
			$model::observe($observer);
		}
	}
}
