<?php

namespace App\Models;

use App\Support\Concerns\GeneratesUniqueKey;
use App\Support\MediaLibrary\Fallback\Cinematography\Cover as CoverFallback;
use App\Support\MediaLibrary\Fallback\Cinematography\Poster as PosterFallback;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
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
 * @property float                                    $rating
 * @property array                                    $meta
 * @property \Spatie\MediaLibrary\Models\Media        $cover
 * @property \Spatie\MediaLibrary\Models\Media        $poster
 * @property \Illuminate\Support\Collection           $resources
 * @property \Illuminate\Support\Collection           $gallery
 * @property \Illuminate\Database\Eloquent\Collection $rates
 * @property \App\Models\SubscriptionPlan             $subscriptionPlan
 * @property-read \Carbon\Carbon                      $produced_at
 * @property-read \Carbon\Carbon                      $updated_at
 * @property-read \Carbon\Carbon                      $created_at
 */
class Cinematography extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, GeneratesUniqueKey;

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
     * Media collection - cinematography resource.
     *
     * @var string
     */
    const MEDIA_COLLECTION_RESOURCE = 'cinematography.resource';

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
    public function getCoverAttribute(): Media
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
     * @return \Illuminate\Support\Collection
     */
    public function getGalleryAttribute(): Collection
    {
        return $this->getMedia(self::MEDIA_COLLECTION_GALLERY);
    }

    /**
     * Get cinematography poster.
     * Get fallback if poster not assigned.
     *
     * @return \Spatie\MediaLibrary\Models\Media
     */
    public function getPosterAttribute(): Media
    {
        $media = $this->getFirstMedia(self::MEDIA_COLLECTION_POSTER);

        if (blank($media) || !is_a($media, Media::class)) {
            $media = new PosterFallback();
        }

        return $media;
    }

    /**
     * Get cinematography resources.
     * Get fallback if poster not assigned.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getResourcesAttribute(): Collection
    {
        return $this->getMedia(self::MEDIA_COLLECTION_RESOURCE);
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
     * Is cinematography type movie.
     *
     * @return bool
     */
    public function isMovie(): bool
    {
        return $this->isType(self::TYPE_MOVIE);
    }

    /**
     * Is cinematography type series.
     *
     * @return bool
     */
    public function isSeries(): bool
    {
        return $this->isType(self::TYPE_SERIES);
    }

    /**
     * Check if cinematography is passed type.
     *
     * @param string $type
     *
     * @return bool
     */
    public function isType(string $type): bool
    {
        return $this->type === $type;
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
