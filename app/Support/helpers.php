<?php

if (!function_exists('rating_format')) {
	/**
	 * Format rating in float with one decimal.
	 *
	 * @param float $rating
	 *
	 * @return float
	 */
	function rating_format(float $rating): float
	{
		return number_format($rating, 1, '.', '');
	}
}
