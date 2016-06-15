<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/5/8
 * Time: 下午2:08
 */

namespace App\Repositories;

use App\User;
use App\Detail;

class DetailRepository {
	/**
	 * Get the detail for a given user.
	 *
	 * @param  User  $user
	 * @return Collection
	 */
	public function forUser(User $user)
	{
		$detailCollection = Detail::where('user_id', $user->id)
			->orderBy('created_at', 'asc')
			->first();
		$ret = [];
		foreach(Detail::$itemText as $key => $text) {
			$ret[$key]['name'] = $key;
			$ret[$key]['cname'] = $text;
			$ret[$key]['value'] = isset($detailCollection->$key) ? $detailCollection->$key : '';
		}
		return $ret;
	}
}
