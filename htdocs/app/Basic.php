<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basic extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id', 'gender', 'city', 'birth_year'
	];
	public static $itemText = [
		'gender'         => '性别',
		'city'           => '城市',
		'birth_year'     => '出生年份'
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
