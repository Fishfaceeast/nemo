<?php

namespace App\Http\Controllers;

use App\About;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
	/**
	 * Create or Update a new about instance
	 */
	protected function update(Request $request) {
		About::updateOrCreate(['user_id' => $request->user()->id], $request->all());
		return redirect('/profile');
	}
}
