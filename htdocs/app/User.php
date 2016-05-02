<?php

//namespace App;
//
//use Illuminate\Foundation\Auth\User as Authenticatable;
//
//class User extends Authenticatable
//{
//    /**
//     * The attributes that are mass assignable.
//     *
//     * @var array
//     */
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];
//
//    /**
//     * The attributes that should be hidden for arrays.
//     *
//     * @var array
//     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];
//}

namespace App;

// Namespace Imports...
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract,
	AuthorizableContract,
	CanResetPasswordContract
{
	use Authenticatable, Authorizable, CanResetPassword;

	// Other Eloquent Properties...

	/**
	 * Get all of the tasks for the user.
	 */
	public function tasks()
	{
		return $this->hasMany(Task::class);
	}
}
