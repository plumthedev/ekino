<?php

namespace App\Models;

use App\Support\MediaLibrary\Fallback\User\ProfilePicture as ProfilePictureFallback;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait as InteractsWithMedia;

/**
 * User model.
 *
 * @property-read int                                 $id
 * @property-read int                                 $subscription_plan_id
 * @property string                                   $first_name
 * @property string                                   $last_name
 * @property string                                   $full_name
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

    /**
     * Get user profile picture.
     * Get fallback profile picture if not assigned.
     *
     * @return \Spatie\MediaLibrary\Models\Media
     */
    public function getProfilePictureAttribute(): Media
    {
        $media = $this->getFirstMedia(self::MEDIA_COLLECTION_PROFILE_PICTURE);

        if (empty($media) || !is_a($media, Media::class)) {
            $media = new ProfilePictureFallback();
        }

        return $media;
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
