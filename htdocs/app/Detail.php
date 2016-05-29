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
	public static $itemText = [
		'orientation'      => '取向',
		'status'           => '状态',
		'nationality'      => '民族',
		'height'           => '身高',
		'weight'           => '体重',
		'smoking'          => '吸烟',
		'drinking'         => '饮酒',
		'religion'         => '宗教',
		'education'        => '教育',
		'offspring'        => '娃',
		'pet'              => '宠物',
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
