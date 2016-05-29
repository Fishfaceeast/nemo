<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/5/5
 * Time: 下午10:17
 */

namespace App\Http\Controllers;

use App\Basic;
use App\Detail;
use App\About;
use App\Target;
use App\Refer;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BasicRepository;
use App\Repositories\DetailRepository;
use App\Repositories\AboutRepository;
use App\Repositories\TargetRepository;
use App\Repositories\ReferRepository;

class ProfileController extends Controller {
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
	 * Display the user's basic info
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function index(Request $request) {
		return view('profile.index', [
			'basic' => $this->basic->forUser($request->user()),
			'detail' => $this->detail->forUser($request->user()),
			'about' => $this->about->forUser($request->user()),
			'target' => $this->target->forUser($request->user()),
			'refers' => $this->refers->forUser($request->user()),
		]);
	}
}
