<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Order model.
 *
 * @property-read int                   $id
 * @property int                        $user_id
 * @property int                        $cinematography_id
 * @property string                     $payment_status
 * @property int                        $cost
 * @property string                     $access_duration
 * @property \App\Models\Access         $access
 * @property \App\Models\User           $user
 * @property \App\Models\Cinematography $cinematography
 * @property-read \Carbon\Carbon        $updated_at
 * @property-read \Carbon\Carbon        $created_at
 */
class Order extends Model
{
    use HasFactory;

    /**
     * Order payment status - canceled.
     *
     * @var string
     */
    const PAYMENT_STATUS_CANCELED = 'canceled';

    /**
     * Order payment status - completed.
     *
     * @var string
     */
    const PAYMENT_STATUS_COMPLETE = 'complete';

    /**
     * Order payment status - pending.
     *
     * @var string
     */
    const PAYMENT_STATUS_PENDING = 'pending';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'cost' => \App\Models\Casts\Money::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_status',
        'cost',
    ];

    /**
     * Return access related model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function access(): HasOne
    {
        return $this->hasOne(
            \App\Models\Access::class,
            'order_id',
            'id'
        );
    }

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
     * Check if order has passed payment status.
     *
     * @param string $status
     *
     * @return bool
     */
    public function hasPaymentStatus(string $status): bool
    {
        return $this->payment_status === $status;
    }

    /**
     * Is order payment canceled.
     *
     * @return bool
     */
    public function isPaymentCanceled(): bool
    {
        return $this->hasPaymentStatus(self::PAYMENT_STATUS_CANCELED);
    }

    /**
     * Is order payment complete.
     *
     * @return bool
     */
    public function isPaymentComplete(): bool
    {
        return $this->hasPaymentStatus(self::PAYMENT_STATUS_COMPLETE);
    }

    /**
     * Is order payment pending.
     *
     * @return bool
     */
    public function isPaymentPending(): bool
    {
        return $this->hasPaymentStatus(self::PAYMENT_STATUS_PENDING);
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
