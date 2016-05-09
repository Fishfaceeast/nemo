<?php

namespace App;

// Namespace Imports...
use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
									AuthorizableContract,
									CanResetPasswordContract
{
	use Authenticatable, Authorizable, CanResetPassword;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * Get all of the tasks for the user.
	 */
	public function tasks()
	{
		return $this->hasMany(Task::class);
	}

	/**
	 * Get the basic for the user.
	 */
	public function basic()
	{
		return $this->hasOne(Basic::class);
	}

	/**
	 * Get the detail for the user.
	 */
	public function detail()
	{
		return $this->hasOne(Detail::class);
	}

	/**
	 * Get the about for the user.
	 */
	public function about()
	{
		return $this->hasOne(About::class);
	}

	/**
	 * Get the target for the user.
	 */
	public function target()
	{
		return $this->hasOne(Target::class);
	}

	/**
	 * Get all of the refers for the user.
	 */
	public function refers()
	{
		return $this->hasMany(Refer::class);
	}
}
