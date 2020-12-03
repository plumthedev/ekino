<?php

namespace App\Support\MediaLibrary\PathGenerator;

use App\Support\MediaLibrary\Contracts\Fallback;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

class Md5PathGenerator implements PathGenerator
{
    /**
     * Get base path.
     *
     * @param \Spatie\MediaLibrary\Models\Media $media
     *
     * @return string
     */
    public function getPath(Media $media) : string
    {
        $uniqueMediaKey = config('medialibrary.key');
        $uniqueMediaKey = "{$uniqueMediaKey}|{$media->id}";

        if ($media instanceof Fallback) {
            return $media->getDirectoryPath();
        }

        return md5($uniqueMediaKey) . '/';
    }

    /**
     * Get path for conversions.
     *
     * @param \Spatie\MediaLibrary\Models\Media $media
     *
     * @return string
     */
    public function getPathForConversions(Media $media) : string
    {
        return $this->getPath($media).'c/';
    }

    /**
     * Get path for responsive images.
     *
     * @param \Spatie\MediaLibrary\Models\Media $media
     *
     * @return string
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media).'/cri/';
    }
}
