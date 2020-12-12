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
    public function allActive()
    {
        return $this->findWhere([
            'is_active' => true,
        ]);
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
