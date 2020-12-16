<?php

namespace App\Repositories\Cinematography;

use App\Models\Cinematography;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Cinematographies repository.
 *
 * @author  Kacper Pruszyński (plumthedev) <kacper.pruszynski99@gmail.com>
 * @version 1.0.0
 */
class Repository extends BaseRepository
{
    /**
     * Get all active cinematographies.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     */
    public function active()
    {
        return $this->findWhere([
            'is_active' => true,
        ]);
    }

    /**
     * Order repository by rating.
     *
     * @param string $direction
     *
     * @return \App\Repositories\Cinematography\Repository
     */
    public function orderByRating(string $direction = 'DESC'): Repository
    {
        return $this->orderBy('rating', $direction);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Cinematography::class;
    }
}
