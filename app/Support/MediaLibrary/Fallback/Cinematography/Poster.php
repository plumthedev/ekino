<?php

namespace App\Support\MediaLibrary\Fallback\Cinematography;

use App\Models\Cinematography;
use App\Support\MediaLibrary\Fallback\Media;

/**
 * Cinematography poster fallback media.
 *
 * @author  Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
class Poster extends Media
{
    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'id'              => 0,
        'model_type'      => Cinematography::class,
        'model_id'        => 0,
        'collection_name' => Cinematography::MEDIA_COLLECTION_POSTER,
        'name'            => 'poster',
        'file_name'       => 'poster.png',
        'mime_type'       => 'image/png',
        'disk'            => 'media',
    ];
}
