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
	public static $itemText = [
		'target_gender'    => '性别',
		'ageMin'           => '最小年龄',
		'ageMax'           => '最大年龄',
		'isSingle'         => '一定要单身么',
		'isNearBy'         => '一定要同城么',
		'relationship'     => '想要怎样的关系',
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
