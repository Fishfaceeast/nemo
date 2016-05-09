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
	protected $basics;
	protected $details;
	protected $abouts;
	protected $targets;
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
	public function __construct(BasicRepository $basics, DetailRepository $details, AboutRepository $abouts, TargetRepository $targets, ReferRepository $refers) {
		$this->middleware('auth');

		$this->basics = $basics;
		$this->details = $details;
		$this->abouts = $abouts;
		$this->targets = $targets;
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
			'basics' => $this->basics->forUser($request->user()),
			'details' => $this->details->forUser($request->user()),
			'abouts' => $this->abouts->forUser($request->user()),
			'targets' => $this->targets->forUser($request->user()),
			'refers' => $this->refers->forUser($request->user()),
		]);
	}
}
