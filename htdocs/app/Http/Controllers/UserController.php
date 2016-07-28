<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/7/27
 * Time: 下午9:44
 */

namespace App\Http\Controllers;

use App\Basic;
use App\Detail;
use App\About;
use App\Target;
use App\Refer;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BasicRepository;
use App\Repositories\DetailRepository;
use App\Repositories\AboutRepository;
use App\Repositories\TargetRepository;
use App\Repositories\ReferRepository;

class UserController extends Controller {
	/**
	 * The basic repository instance.
	 *
	 * @var BasicRepository
	 */
	protected $basic;
	protected $detail;
	protected $about;
	protected $target;
	protected $refers;

	/**
	 * Create a new controller instance.
	 *
	 * @param  BasicRepository  $basic
	 * @param  DetailRepository  $detail
	 * @param  AboutRepository  $about
	 * @param  TargetRepository  $target
	 * @param  ReferRepository  $refer
	 * @return void
	 */
	public function __construct(BasicRepository $basic, DetailRepository $detail, AboutRepository $about, TargetRepository $target, ReferRepository $refers) {
		$this->middleware('auth');

		$this->basic = $basic;
		$this->detail = $detail;
		$this->about = $about;
		$this->target = $target;
		$this->refers = $refers;
	}


	/**
	 * Display the user's info
	 */
	public function index($uid) {
		$user = User::find($uid);
		if($user) {
			return view('user.index', [
				'basic'    => $this->basic->forUser($user),
				'detail'   => $this->detail->forUser($user),
				'about'    => $this->about->forUser($user),
				'target'   => $this->target->forUser($user),
				'refers'   => $this->refers->forUser($user),
				'userName' => $user->name,
				'location' => 'user',
			]);
		} else {
			return redirect('/match');
		}
	}
}
