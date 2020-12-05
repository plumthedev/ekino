<?php

namespace App\Support\MediaLibrary\Fallback;

use InvalidArgumentException;

use Illuminate\Support\Str;

use Spatie\MediaLibrary\Models\Media as Model;

use App\Support\MediaLibrary\Contracts\FallbackMedia as Contract;

/**
 * Fallback media.
 *
 * @author  Kacper Pruszyński (plumthedev) <kacper.pruszysnki99@gmail.com>
 * @version 1.0.0
 */
abstract class Media extends Model implements Contract
{
    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'id'              => 0,
        'model_type'      => \Illuminate\Database\Eloquent\Model::class,
        'model_id'        => 0,
        'collection_name' => 'default',
        'name'            => 'media',
        'file_name'       => 'media.png',
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
        $modelType = $this->model_type;

        if (blank($modelType) || !is_string($modelType)) {
            throw new InvalidArgumentException(
                sprintf('Fallback media class [%s] does not have defined model type attribute.', get_class($this))
            );
        }

        $className = class_basename($modelType);
        $className = Str::lower($className);

        if (blank($className)) {
            throw new InvalidArgumentException(
                sprintf('Fallback media class [%s] does not have defined property model type class name.', get_class($this))
            );
        }

        return sprintf('fallback/%s/', $className);
    }
}
