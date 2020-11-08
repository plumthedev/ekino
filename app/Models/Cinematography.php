<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Cinematography model.
 *
 * @property int                                      $id
 * @property string                                   $type
 * @property string                                   $title
 * @property string                                   $content
 * @property string|null                              $duration
 * @property string                                   $rating
 * @property array                                    $meta
 * @property \Illuminate\Database\Eloquent\Collection $rates
 * @property-read \Carbon\Carbon                      $produced_at
 * @property-read \Carbon\Carbon                      $updated_at
 * @property-read \Carbon\Carbon                      $created_at
 */
class Cinematography extends Model
{
	use HasFactory;

	/**
	 * Cinematography movie type.
	 *
	 * @var string
	 */
	const TYPE_MOVIE = 'movie';

	/**
	 * Cinematography series type.
	 *
	 * @var string
	 */
	const TYPE_SERIES = 'series';

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'rating'      => 'float',
		'meta'        => 'array',
		'produced_at' => 'datetime',
	];

	/**
	 * Rating attribute getter.
	 *
	 * @return float
	 */
	public function getRatingAttribute(): float
	{
		$rating = $this->attributes['rating'] ?? 0;
		return rating_format($rating);
	}

	/**
	 * Get cinematography related rates.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function rates(): HasMany
	{
		return $this->hasMany(\App\Models\Rate::class, 'cinematography_id', 'id');
	}

	/**
	 * Rating attribute setter.
	 *
	 * @param float $rating
	 */
	public function setRatingAttribute(float $rating)
	{
		$this->attributes['rating'] = rating_format($rating);
	}
}
