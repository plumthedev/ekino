<?php

namespace App\Models;

use App\Support\MediaLibrary\Fallback\User\ProfilePicture as ProfilePictureFallback;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait as InteractsWithMedia;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Permission\Traits\HasRoles;

/**
 * User model.
 *
 * @property-read int                                 $id
 * @property string|null                              $first_name
 * @property string|null                              $last_name
 * @property string                                   $full_name
 * @property string|null                              $country
 * @property string|null                              $phone_number
 * @property string|null                              $street_address
 * @property string|null                              $building_number
 * @property string|null                              $zip_code
 * @property string|null                              $city
 * @property string                                   $email
 * @property string                                   $password
 * @property \Spatie\MediaLibrary\Models\Media        $profile_picture
 * @property \Illuminate\Database\Eloquent\Collection $orders
 * @property \Illuminate\Database\Eloquent\Collection $rates
 * @property-read \Carbon\Carbon                      $verified_at
 * @property-read \Carbon\Carbon                      $updated_at
 * @property-read \Carbon\Carbon                      $created_at
 */
class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    /**
     * Media collection - cinematography profile picture.
     *
     * @var string
     */
    const MEDIA_COLLECTION_PROFILE_PICTURE = 'user.profile_picture';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'verified_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get user related accesses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accesses(): HasMany
    {
        return $this->hasMany(
            \App\Models\Access::class,
            'user_id',
            'id'
        );
    }

    /**
     * Full name attribute getter.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        $fullName = "{$this->first_name} {$this->last_name}";
        return trim($fullName);
    }

    /**
     * Get user profile picture.
     * Get fallback profile picture if not assigned.
     *
     * @return \Spatie\MediaLibrary\Models\Media
     */
    public function getProfilePictureAttribute(): Media
    {
        $media = $this->getFirstMedia(self::MEDIA_COLLECTION_PROFILE_PICTURE);

        if (empty($media) || ! is_a($media, Media::class)) {
            $media = new ProfilePictureFallback();
        }

        return $media;
    }

    /**
     * Determine if the user has verified their email address.
     *
     * @return bool
     */
    public function hasVerifiedEmail(): bool
    {
        return ! is_null($this->verified_at);
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified(): bool
    {
        return $this->forceFill([
            'verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Get user related orders.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(
            \App\Models\Order::class,
            'user_id',
            'id'
        );
    }

    /**
     * Get user related rates.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rates(): HasMany
    {
        return $this->hasMany(
            \App\Models\Rate::class,
            'user_id',
            'id'
        );
    }

    public function setCountryAttribute(?string $country): void
    {
        if (! is_string($country)) {
            return;
        }

        $this->attributes['country'] = Str::upper($country);
    }

    /**
     * Password setter.
     * Remember to always hash passwords in databases.
     *
     * @param string $password
     */
    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
