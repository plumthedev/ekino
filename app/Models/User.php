<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

/**
 * User model.
 *
 * @property-read int                                 $id
 * @property-read int                                 $subscription_plan_id
 * @property string                                   $first_name
 * @property string                                   $last_name
 * @property string                                   $full_name
 * @property string                                   $email
 * @property string                                   $password
 * @property \Illuminate\Database\Eloquent\Collection $orders
 * @property \Illuminate\Database\Eloquent\Collection $rates
 * @property-read \Carbon\Carbon                      $verified_at
 * @property-read \Carbon\Carbon                      $updated_at
 * @property-read \Carbon\Carbon                      $created_at
 */
class User extends Authenticatable
{
	use HasFactory, Notifiable, HasRoles;

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'verified_at' => 'datetime',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name',
		'last_name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
	];

	/**
	 * Full name attribute getter.
	 *
	 * @return string
	 */
	public function getFullNameAttribute(): string
	{
		$fullName = "{$this->first_name} {$this->last_name}";
		return trim($fullName);
	}

	/**
	 * Get user related orders.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function orders(): HasMany
	{
		return $this->hasMany(
			\App\Models\Order::class,
			'user_id',
			'id'
		);
	}

	/**
	 * Get user related rates.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function rates(): HasMany
	{
		return $this->hasMany(
			\App\Models\Rate::class,
			'user_id',
			'id'
		);
	}

	/**
	 * Password setter.
	 * Remember to always hash passwords in databases.
	 *
	 * @param string $password
	 */
	public function setPasswordAttribute(string $password): void
	{
		$this->attributes['password'] = Hash::make($password);
	}
}
