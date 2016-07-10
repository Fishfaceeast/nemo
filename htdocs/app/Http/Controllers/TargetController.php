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
		$fields = [];
		foreach($request->all() as $key => $value) {
			$fields[$key] = $value ? $value : null;
		}
		try {
			Target::updateOrCreate(['user_id' => $request->user()->id], $fields);
			return response()->json('success');
		} catch(Exception $e) {
			return response()->json('error: ' .$e->getMessage());
		}
	}
}
