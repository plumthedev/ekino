<?php

namespace App\Support\MediaLibrary\Fallback\User;

use App\Support\MediaLibrary\Fallback\Media;

/**
 * User profile picture fallback media.
 *
 * @author  Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
class ProfilePicture extends Media
{
    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'id'              => 0,
        'model_type'      => \App\Models\User::class,
        'model_id'        => 0,
        'collection_name' => \App\Models\User::MEDIA_COLLECTION_PROFILE_PICTURE,
        'name'            => 'poster',
        'file_name'       => 'profile-picture.png',
        'mime_type'       => 'image/png',
        'disk'            => 'media',
    ];
}
