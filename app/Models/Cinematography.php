<?php

namespace App\Models;

use App\Support\MediaLibrary\Fallback\Cinematography\Cover as CoverFallback;
use App\Support\MediaLibrary\Fallback\Cinematography\Poster as PosterFallback;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait as InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollection\MediaCollection;
use Spatie\MediaLibrary\Models\Media;

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
     * Get cinematography cover.
     * Get fallback if cover not assigned.
     *
     * @return \Spatie\MediaLibrary\Models\Media
     */
    public function getCover(): Media
    {
        $media = $this->getFirstMedia(self::MEDIA_COLLECTION_COVER);

        if (blank($media) || !is_a($media, Media::class)) {
            $media = new CoverFallback();
        }

        return $media;
    }

    /**
     * Get cinematography gallery.
     *
     * @return \Spatie\MediaLibrary\MediaCollection\MediaCollection|null
     */
    public function getGallery(): ?MediaCollection
    {
        return $this->getMediaCollection(self::MEDIA_COLLECTION_GALLERY);
    }

    /**
     * Get cinematography poster.
     * Get fallback if poster not assigned.
     *
     * @return \Spatie\MediaLibrary\Models\Media
     */
    public function getPoster(): Media
    {
        $media = $this->getFirstMedia(self::MEDIA_COLLECTION_POSTER);

        if (blank($media) || !is_a($media, Media::class)) {
            $media = new PosterFallback();
        }

        return $media;
    }

    /**
     * Rating attribute getter.
     *
     * @return float
     */
    public function getRatingAttribute(): float
    {
        $rating = $this->attributes['rating'];

        if (!is_numeric($rating)) {
            $rating = 0;
        }

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
