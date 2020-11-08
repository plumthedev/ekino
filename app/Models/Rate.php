<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Rate model.
 *
 * @property int                        $id
 * @property int                        $user_id
 * @property int                        $cinematography_id
 * @property float                      $score
 * @property string                     $content
 * @property int                        $rating
 * @property array                      $usefulness
 * @property \App\Models\User           $author
 * @property \App\Models\Cinematography $cinematography
 * @property-read \Carbon\Carbon        $updated_at
 * @property-read \Carbon\Carbon        $created_at
 */
class Rate extends Model
{
	use HasFactory;

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'score' => 'float',
	];

	/**
	 * Get rate author.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function author(): BelongsTo
	{
		return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
	}

	/**
	 * Get rate cinematography.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function cinematography(): BelongsTo
	{
		return $this->belongsTo(\App\Models\Cinematography::class, 'cinematography_id', 'id');
	}

	/**
	 * Score attribute getter.
	 *
	 * @return float
	 */
	public function getScoreAttribute(): float
	{
		$score = $this->attributes['score'] ?? 0;
		return rating_format($score);
	}

	/**
	 * Score attribute setter.
	 *
	 * @param float $score
	 */
	public function setScoreAttribute(float $score)
	{
		$this->attributes['score'] = rating_format($score);
	}
}
