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
		return Detail::where('user_id', $user->id)
			->orderBy('created_at', 'asc')
			->get();
	}
}
