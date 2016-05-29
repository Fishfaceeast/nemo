<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/5/7
 * Time: 上午11:15
 */

namespace App\Repositories;

use App\User;
use App\Basic;

class BasicRepository {
	/**
	 * Get the basic for a given user.
	 *
	 * @param  User  $user
	 * @return Collection
	 */
	public function forUser(User $user)
	{
		return Basic::where('user_id', $user->id)
			->orderBy('created_at', 'asc')
			->first();
	}
}
