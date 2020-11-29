<?php

namespace App\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Money\Currency;
use Money\Formatter\DecimalMoneyFormatter;

class Money implements CastsAttributes
{
	/**
	 * Money currency.
	 *
	 * @var \Money\Currency
	 */
	protected $currency;


	/**
	 * Money decimal formatter.
	 *
	 * @var \Money\Formatter\DecimalMoneyFormatter
	 */
	protected $decimalMoneyFormatter;

	/**
	 * Money cast constructor.
	 *
	 * @throws \Illuminate\Contracts\Container\BindingResolutionException
	 */
	public function __construct()
	{
		$this->currency = app()->make(Currency::class);
		$this->decimalMoneyFormatter = app()->make(DecimalMoneyFormatter::class);
	}

	/**
	 * Cast the given value.
	 *
	 * @param \Illuminate\Database\Eloquent\Model $model
	 * @param string                              $key
	 * @param mixed                               $value
	 * @param array                               $attributes
	 *
	 * @return \Money\Money
	 */
	public function get($model, string $key, $value, array $attributes): \Money\Money
	{
		return new \Money\Money(
			$value,
			$this->currency
		);
	}

	/**
	 * Prepare the given value for storage.
	 *
	 * @param \Illuminate\Database\Eloquent\Model $model
	 * @param string                              $key
	 * @param mixed                               $value
	 * @param array                               $attributes
	 *
	 * @return float
	 */
	public function set($model, string $key, $value, array $attributes): float
	{
		if (is_object($value) && is_a($value, \Money\Money::class)) {
			$value = $this->decimalMoneyFormatter->format($value);
		}

		// convert value into pennies
		$value = $value * 100;

		return $value;
	}
}
