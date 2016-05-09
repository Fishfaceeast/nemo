<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'orientation',
		'status',
		'nationality',
		'height',
		'weight',
		'smoking',
		'drinking',
		'religion',
		'education',
		'offspring',
		'pet',
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
