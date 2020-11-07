<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * User model.
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $full_name
 * @property string $email
 * @property string $password
 * @property-read \Carbon\Carbon $verified_at
 * @property-read \Carbon\Carbon $updated_at
 * @property-read \Carbon\Carbon $created_at
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	/**
	 * Password mutator.
	 * Remember to always hash passwords in databases.
	 *
	 * @param string $password
	 */
	public function setPasswordAttribute(string $password): void
	{
		$this->attributes['password'] = Hash::make($password);
    }

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
}
