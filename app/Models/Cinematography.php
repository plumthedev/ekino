<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait as InteractsWithMedia;

/**
 * Cinematography model.
 *
 * @property int                                      $id
 * @property string                                   $type
 * @property string                                   $title
 * @property string                                   $content
 * @property string|null                              $duration
 * @property string                                   $float
 * @property array                                    $meta
 * @property \Illuminate\Database\Eloquent\Collection $rates
 * @property \App\Models\SubscriptionPlan             $subscriptionPlan
 * @property-read \Carbon\Carbon                      $produced_at
 * @property-read \Carbon\Carbon                      $updated_at
 * @property-read \Carbon\Carbon                      $created_at
 */
class Cinematography extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * Media collection - cinematography cover.
     *
     * @var string
     */
    const MEDIA_COLLECTION_COVER = 'cinematography.cover';

    /**
     * Media collection - cinematography poster.
     *
     * @var string
     */
    const MEDIA_COLLECTION_POSTER = 'cinematography.poster';

    /**
     * Media collection - cinematography gallery.
     *
     * @var string
     */
    const MEDIA_COLLECTION_GALLERY = 'cinematography.gallery';

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
	 * Get cinematography related actors.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function actors(): BelongsToMany
	{
		return $this->belongsToMany(
            Actor::class,
            'actor_performs',
            'cinematography_id',
            'actor_id',
        )->withPivot(['perform_name']);
	}

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
		return $this->hasMany(
            Rate::class,
            'cinematography_id',
            'id'
        );
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

	/**
	 * Get cinematography related subscription plans.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function subscriptionPlan(): BelongsTo
	{
		return $this->belongsTo(
            SubscriptionPlan::class,
            'subscription_plan_id',
            'id'
        );
	}
}
