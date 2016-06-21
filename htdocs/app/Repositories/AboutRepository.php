<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/5/9
 * Time: 下午9:52
 */

namespace App\Repositories;

use App\User;
use App\About;

class AboutRepository {
	/**
	 * Get the about for a given user.
	 *
	 * @param  User  $user
	 * @return Collection
	 */
	public function forUser(User $user)
	{
		$aboutCollection = About::where('user_id', $user->id)
			->orderBy('created_at', 'asc')
			->first();
		$ret = [];
		foreach(About::$itemText as $key => $text) {
			$ret[$key]['name'] = $key;
			$ret[$key]['cname'] = $text;
			$ret[$key]['value'] = isset($aboutCollection->$key) ? $aboutCollection->$key : '';
		}
		return $ret;
	}
}
