<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/5/9
 * Time: 下午11:25
 */

namespace App\Repositories;

use App\User;
use App\Refer;

class ReferRepository {
	/**
	 * Get the refer for a given user.
	 *
	 * @param  User  $user
	 * @return Collection
	 */
	public function forUser(User $user)
	{
		$referCollection = Refer::where('user_id', $user->id)
			->orderBy('created_at', 'asc')
			->first();
		$ret = [];
		foreach(Refer::$itemText as $key => $text) {
			$ret[$key]['name'] = $key;
			$ret[$key]['cname'] = $text;
			$ret[$key]['value'] = isset($referCollection->$key) ? $referCollection->$key : '';
		}
		return $ret;
	}
}
