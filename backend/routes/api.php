<?php


use App\Http\Controllers\VerificationController;
use App\Http\Controllers\FunilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmaiController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EtapaController;
use App\Http\Controllers\UserController;

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




Route::middleware('jwt.auth')->group(function () {

    Route::post('me', 'App\Http\Controllers\AuthController@me');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');




   
});

Route::prefix('funis/{funilId}')->group(function () {
    Route::get('etapas', [EtapaController::class, 'index']);
    Route::post('etapas', [EtapaController::class, 'store']);
    Route::put('etapas/{id}', [EtapaController::class, 'update']);
    Route::delete('etapas/{id}', [EtapaController::class, 'destroy']);
    Route::post('etapas/order', [EtapaController::class, 'updateOrder']);

});
Route::apiResource('register-funil','App\Http\Controllers\FunilController');


Route::post('login', [AuthController::class, 'login'])->name('login');

Route::apiResource('register-user','App\Http\Controllers\UserController');


Route::post('forget-password', [EmailController::class, 'sendPasswordChange'])->middleware('guest')->name('forget_password');
Route::post('reset-password', [EmailController::class, 'resetPassword'])->middleware('guest')->name('password.update');
Route::middleware('signed')->group(function () {
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
});



