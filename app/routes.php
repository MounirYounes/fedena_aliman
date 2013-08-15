<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('create', function()
{
	return View::make('create');
});



Route::post('return', function(){
	sleep(1);
	echo "Hello";
});


Route::get('test', function(){
	$timings = TimetableEntry::all();
	return View::make('test')->with('timings', $timings);
});