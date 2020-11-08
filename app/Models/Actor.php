<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * User model.
 *
 * @property-read int            $id
 * @property string              $first_name
 * @property string              $last_name
 * @property string              $full_name
 * @property string|null         $biography
 * @property string|null         $perform_name
 * @property-read \Carbon\Carbon $updated_at
 * @property-read \Carbon\Carbon $created_at
 */
class Actor extends Model
{
	use HasFactory;

	/**
	 * Get actor related cinematographies.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function cinematographies()
	{
		return $this->belongsToMany(
			Cinematography::class,
			'actor_performs',
			'actor_id',
			'cinematography_id',
		)->withPivot(['perform_name']);
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
