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
 * @property \App\Models\User           $user
 * @property \App\Models\Cinematography $cinematography
 * @property-read \Carbon\Carbon        $updated_at
 * @property-read \Carbon\Carbon        $created_at
 */
class Order extends Model
{
	use HasFactory;

	const PAYMENT_STATUS_PENDING = 'pending';

	const PAYMENT_STATUS_COMPLETE = 'complete';

	const PAYMENT_STATUS_CANCELED = 'canceled';

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
	 * Return user related model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function user(): HasOne
	{
		return $this->hasOne(User::class, 'user_id', 'id');
	}

	/**
	 * Return cinematography related model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function cinematography(): HasOne
	{
		return $this->hasOne(Cinematography::class, 'cinematography_id', 'id');
	}
}
