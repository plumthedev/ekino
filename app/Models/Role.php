<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as Model;

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
