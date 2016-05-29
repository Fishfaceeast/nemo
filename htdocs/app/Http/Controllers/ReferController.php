<?php
/**
 * Created by PhpStorm.
 * User: yuqian
 * Date: 16/5/9
 * Time: 下午11:27
 */

namespace App\Http\Controllers;

use App\Refer;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReferController extends Controller
{
	/**
	 * Create or Update a new refer instance
	 *
	 * @return Refer
	 */
	protected function update(Request $request) {
		try {
			Refer::updateOrCreate(['user_id' => $request->user()->id], $request->all());
			return response()->json('success');
		} catch(Exception $e) {
			return response()->json('error: ' .$e->getMessage());
		}
	}
}
