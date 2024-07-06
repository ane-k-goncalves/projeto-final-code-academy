<?php

use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmaiController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidateEmailcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->middleware('jwt.auth')->group(function () {

    Route::post('me', 'App\Http\Controllers\AuthController@me');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::apiResource('register-funil','App\Http\Controllers\FunilController');
});

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::apiResource('register-user','App\Http\Controllers\UserController');



Route::post('forget-password', [EmailController::class, 'sendPasswordChange'])
    ->middleware('guest')
    ->name('forget_password');


Route::post('reset-password', [EmailController::class, 'resetPassword'])
->middleware('guest')
->name('password.update');

Route::post('email/verify', [ValidateEmailcontroller::class, 'verifyEmail'])
->middleware('auth') 
->name('verification.send');
