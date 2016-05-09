<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id', 'target_gender', 'ageMin', 'ageMax', 'isSingle', 'isNearBy', 'relationship'
	];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	/**
	 * Get the user that owns the basic.
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
