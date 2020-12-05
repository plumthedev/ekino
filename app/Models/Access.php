<?php

namespace App\Models;

use App\Support\Concerns\GeneratesUniqueKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Access model.
 *
 * @property-read int                   $id
 * @property int                        $user_id
 * @property int                        $order_id
 * @property int                        $cinematography_id
 * @property string                     $status
 * @property \App\Models\User           $user
 * @property \App\Models\Order          $order
 * @property \App\Models\Cinematography $cinematography
 * @property \Carbon\Carbon             $started_at
 * @property \Carbon\Carbon             $ended_at
 * @property-read \Carbon\Carbon        $updated_at
 * @property-read \Carbon\Carbon        $created_at
 */
class Access extends Model
{
    use HasFactory, GeneratesUniqueKey;

    /**
     * Access status - allow.
     *
     * @var string
     */
    const STATUS_ALLOWED = 'allowed';

    /**
     * Access status - denied.
     *
     * @var string
     */
    const STATUS_DENIED = 'denied';

    /**
     * Return cinematography related model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cinematography(): HasOne
    {
        return $this->hasOne(
            \App\Models\Cinematography::class,
            'id',
            'cinematography_id'
        );
    }

    /**
     * Return order related model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function order(): HasOne
    {
        return $this->hasOne(
            \App\Models\Order::class,
            'id',
            'order_id'
        );
    }

    /**
     * Return user related model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(
            \App\Models\User::class,
            'id',
            'user_id'
        );
    }
}
