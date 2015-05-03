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

Route::get('/', 'ApuestasController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// Provide controller methods with object instead of ID
Route::model('apuestas', 'Models\Apuestas');

// Use slugs rather than IDs in URLs
Route::bind('apuestas', function($value, $route) {
	return App\Models\Apuestas::whereSlug($value)->first();
});

Route::resource('apuestas', 'ApuestasController');
