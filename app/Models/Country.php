<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Country model.
 *
 * @property-read int            $id
 * @property string              $name
 * @property-read \Carbon\Carbon $updated_at
 * @property-read \Carbon\Carbon $created_at
 */
class Country extends Model
{
    use HasFactory;

    /**
     * Get country related cinematographies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cinematographies(): BelongsToMany
    {
        return $this->belongsToMany(
            Cinematography::class,
            'actor_performs',
            'actor_id',
            'cinematography_id',
        );
    }
}
