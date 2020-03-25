<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return [
        'app' => 'Laravel 6 - ' . env('APP_NAME'),
        'version' => config('api.version'),
    ];
});

Route::namespace('Auth')->prefix('auth')->group(function () {
    // Login route
    Route::post('login', [AuthController::class, 'login']);
    //Register route
    Route::post('register', 'RegisterController@register');
    // Send reset password mail
    Route::post('recovery', 'ForgotPasswordController@sendPasswordResetLink');
    // handle reset password form process
    Route::post('reset', 'ResetPasswordController@callResetPassword');
});

Route::group(['middleware' => ['jwt', 'jwt.auth']], function () {
    Route::group(['namespace' => 'Profile'], function () {
        Route::get('profile', 'ProfileController@me');
        Route::put('profile', 'ProfileController@update');
        Route::put('profile/password', 'ProfileController@updatePassword');
    });

    Route::group(['namespace' => 'Auth'], function () {
        Route::post('logout', 'LogoutController@logout');
    });
});
