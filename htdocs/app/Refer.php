<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Refer extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id', 'why', 'description', 'story'
	];

	public static $itemText = [
		'why'           => '推荐原因',
		'description'   => '描述',
		'story'         => '你们的故事',
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
