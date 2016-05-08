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
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BasicRepository;
use App\Repositories\DetailRepository;

class ProfileController extends Controller {
	/**
	 * The basic repository instance.
	 *
	 * @var BasicRepository
	 */
	protected $basics;
	protected $details;

	/**
	 * Create a new controller instance.
	 *
	 * @param  BasicRepository  $basic
	 * @return void
	 */
	public function __construct(BasicRepository $basics, DetailRepository $details) {
		$this->middleware('auth');

		$this->basics = $basics;
		$this->details = $details;
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
		]);
	}
}
