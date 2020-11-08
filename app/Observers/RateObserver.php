<?php

namespace App\Observers;

use App\Models\Cinematography;
use App\Models\Rate;

class RateObserver
{
	/**
	 * Handle created rate.
	 *
	 * @param \App\Models\Rate $rate
	 */
	public function created(Rate $rate): void
	{
		$this->updateCinematographyRating($rate->cinematography);
	}

	/**
	 * Update cinematographic rating based on average of all rates.
	 *
	 * @param \App\Models\Cinematography $cinematography
	 */
	protected function updateCinematographyRating(Cinematography $cinematography): void
	{
		$rates = $cinematography->rates->pluck('score')->values();
		$cinematography->rating = $rates->average();

		$cinematography->save();
	}
}
