<?php

namespace App\Http\Controllers;

use App\Target;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TargetController extends Controller {
	/**
	 * Create or Update a new Target instance
	 */
	protected function update(Request $request) {
		try {
			Target::updateOrCreate(['user_id' => $request->user()->id], $request->all());
			return response()->json('success');
		} catch(Exception $e) {
			return response()->json('error: ' .$e->getMessage());
		}
	}
}
