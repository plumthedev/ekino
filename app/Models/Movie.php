<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Movie model.
 *
 * @property int                 $id
 * @property string              $title
 * @property string              $content
 * @property string              $duration
 * @property string              $rating
 * @property array               $meta
 * @property-read \Carbon\Carbon $produced_at
 * @property-read \Carbon\Carbon $updated_at
 * @property-read \Carbon\Carbon $created_at
 */
class Movie extends Model
{
	use HasFactory;

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
	 * Rating attribute setter.
	 *
	 * @param float $rating
	 */
	public function setRatingAttribute(float $rating)
	{
		$this->attributes['rating'] = rating_format($rating);
	}
}
