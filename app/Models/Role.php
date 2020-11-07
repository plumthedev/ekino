<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as Model;

/**
 * Role model.
 *
 * @property-read int            $id
 * @property string              $name
 * @property string              $guard_name
 * @property-read \Carbon\Carbon $updated_at
 * @property-read \Carbon\Carbon $created_at
 */
class Role extends Model
{
	use HasFactory;

	/**
	 * User role administrator.
	 *
	 * @var string
	 */
	const ADMINISTRATOR = 'administrator';

	/**
	 * Basic user role.
	 *
	 * @var string
	 */
	const USER = 'user';
}
