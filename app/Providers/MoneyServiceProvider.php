<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\DecimalMoneyFormatter;

class MoneyServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->bindCurrency();
		$this->bindDecimalMoneyFormatter();
	}

	/**
	 * Bind currency in application.
	 *
	 * @return void
	 */
	protected function bindCurrency(): void
	{
		$this->app->bind(Currency::class, function () {
			return new Currency(
				config('money.currency', 'PLN')
			);
		});
	}

	/**
	 * Bind application decimal money formater.
	 *
	 * @return void
	 */
	protected function bindDecimalMoneyFormatter(): void
	{
		$this->app->bind(DecimalMoneyFormatter::class, function () {
			return new DecimalMoneyFormatter(
				new ISOCurrencies()
			);
		});
	}
}
