<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Login route
Route::post('login', [AuthController::class, 'login']);

//Register route
Route::post('register', [RegisterController::class, 'register']);

// Send reset password mail
Route::post('recovery', [ForgotPasswordController::class, 'sendPasswordResetLink']);

// handle reset password form process
Route::post('reset', [ResetPasswordController::class, 'callResetPassword']);
