<?php

namespace App\Http\Controllers;

use App\Basic;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BasicController extends Controller
{
	/**
	 * Create or Update a new basic instance
	 *
	 * @return Basic
	 */
	protected function update(Request $request) {
		try {
			Basic::updateOrCreate(['user_id' => $request->user()->id], $request->all());
			return response()->json('success');
		} catch(Exception $e) {
			return response()->json('error: ' .$e->getMessage());
		}
	}
}
