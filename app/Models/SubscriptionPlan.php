<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Subscription plan model.
 *
 * @property-read int                                 $id
 * @property string                                   $name
 * @property string                                   $description
 * @property \Money\Money                             $price
 * @property boolean                                  $is_featured
 * @property string                                   $access_duration
 * @property \Illuminate\Database\Eloquent\Collection $cinematographies
 * @property-read \Carbon\Carbon                      $updated_at
 * @property-read \Carbon\Carbon                      $created_at
 */
class SubscriptionPlan extends Model
{
	use HasFactory;

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'price'           => \App\Models\Casts\Money::class,
		'is_featured'     => 'bool',
		'access_duration' => 'integer',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'description',
		'price',
		'is_featured',
		'access_duration',
	];

	/**
	 * Get subscription plans related cinematographies.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function cinematographies(): HasMany
	{
		return $this->hasMany(
			\App\Models\Cinematography::class,
			'subscription_plan_id',
			'id'
		);
	}
}
