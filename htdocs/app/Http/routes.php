<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//use App\Task;
//use Illuminate\Http\Request;
//
//Route::get('/', function () {
//	$tasks = Task::orderBy('created_at', 'asc')->get();
//
//	return view('tasks', [
//		'tasks' => $tasks
//	]);
//});
//
//Route::post('/task', function (Request $request) {
//	$validator = Validator::make($request->all(), [
//		'name' => 'required|max:255',
//	]);
//
//	if ($validator->fails()) {
//		return redirect('/')
//			->withInput()
//			->withErrors($validator);
//	}
//
//	$task = new Task;
//	$task->name = $request->name;
//	$task->save();
//
//	return redirect('/');
//});
//
//Route::delete('/task/{id}', function($id) {
//	Task::findOrFail($id)->delete();
//
//	return redirect('/');
//});

use App\Task;
use Illuminate\Http\Request;

// Authentication Routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Task Routes...
Route::get('/tasks', 'TaskController@index');
Route::post('/task', 'TaskController@store');
Route::delete('/task/{task}', 'TaskController@destroy');

// Profile Routes...
Route::get('/profile', 'ProfileController@index');

// Basic Info Routes...
Route::post('/basic/update', 'BasicController@update');

Route::get('/', function () {
	return redirect('/tasks');
});

Route::auth();

Route::get('/home', function () {
	return redirect('/tasks');
});
