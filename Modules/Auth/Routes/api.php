<?php

// Login route
use Modules\Auth\Http\Controllers\AuthController;
use Modules\Auth\Http\Controllers\ForgotPasswordController;
use Modules\Auth\Http\Controllers\RegisterController;
use Modules\Auth\Http\Controllers\ResetPasswordController;

Route::post('login', [AuthController::class, 'login']);
//Register route
Route::post('register', [RegisterController::class, 'register']);

// Send reset password mail
Route::post('recovery', [ForgotPasswordController::class, 'sendPasswordResetLink']);

// handle reset password form process
Route::post('reset', [ResetPasswordController::class, 'callResetPassword']);
