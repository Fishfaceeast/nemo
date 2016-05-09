<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id', 'summary', 'routine', 'skills', 'favorite', 'necessities', 'concerns', 'friday'
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
