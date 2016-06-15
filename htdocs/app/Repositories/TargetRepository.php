<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/5/9
 * Time: 下午9:52
 */

namespace App\Repositories;

use App\User;
use App\Target;

class TargetRepository {
	/**
	 * Get the target for a given user.
	 *
	 * @param  User  $user
	 * @return Collection
	 */
	public function forUser(User $user)
	{
		$targetCollection = Target::where('user_id', $user->id)
			->orderBy('created_at', 'asc')
			->first();
		$ret = [];
		foreach(Target::$itemText as $key => $text) {
			$ret[$key]['name'] = $key;
			$ret[$key]['cname'] = $text;
			$ret[$key]['value'] = isset($targetCollection->$key) ? $targetCollection->$key : '';
		}
		return $ret;
	}
}
