<?php

namespace App\Support\MediaLibrary\Fallback\Actor;

use App\Support\MediaLibrary\Fallback\Media;

/**
 * Actor avatar fallback media.
 *
 * @author  Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
class Avatar extends Media
{
    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'id'              => 0,
        'model_type'      => \App\Models\Actor::class,
        'model_id'        => 0,
        'collection_name' => \App\Models\Actor::MEDIA_COLLECTION_AVATAR,
        'name'            => 'avatar',
        'file_name'       => 'avatar.png',
        'mime_type'       => 'image/png',
        'disk'            => 'media',
    ];
}
