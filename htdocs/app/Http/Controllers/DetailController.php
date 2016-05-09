<?php

namespace App\Http\Controllers;

use App\Detail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailController extends Controller
{
	/**
	 * Create or Update a new detail instance
	 *
	 * @return Detail
	 */
	protected function update(Request $request) {
		Detail::updateOrCreate(['user_id' => $request->user()->id], $request->all());
		return redirect('/profile');
	}
}
