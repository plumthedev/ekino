<?php

namespace App\Support\MediaLibrary\Fallback\Actor;

use App\Models\Actor;
use App\Support\MediaLibrary\Contracts\Fallback;
use Spatie\MediaLibrary\Models\Media;

/**
 * Actor avatar fallback media.
 *
 * @author  Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
class Avatar extends Media implements Fallback
{
    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'id'              => 0,
        'model_type'      => Actor::class,
        'model_id'        => 0,
        'collection_name' => Actor::MEDIA_COLLECTION_AVATAR,
        'name'            => 'avatar',
        'file_name'       => 'avatar.png',
        'mime_type'       => 'image/png',
        'disk'            => 'media',
    ];

    /**
     * Get media fallback directory path.
     *
     * @return string
     */
    public function getDirectoryPath(): string
    {
        return 'fallback/actor/';
    }
}
