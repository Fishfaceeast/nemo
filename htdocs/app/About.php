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
	public static $itemText = [
		'summary'       => '关于我',
		'routine'       => '每天都在干啥',
		'skills'        => '我比较擅长',
		'favorite'      => '我最喜欢的书/电影/音乐/食物',
		'necessities'   => '没有这几样我会抓狂',
		'concerns'      => '我会想这些问题',
		'friday'        => '周五晚上我会做些啥',
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
