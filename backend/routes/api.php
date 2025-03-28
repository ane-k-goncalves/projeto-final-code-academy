<?php


use App\Http\Controllers\VerificationController;
use App\Http\Controllers\FunilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EtapaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContatoController;

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

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('jwt.auth')->group(function () {
    Route::post('me', [AuthController::class, 'me']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('funis', FunilController::class);

    Route::prefix('funis/{funilId}')->group(function () {
        Route::get('etapas', [EtapaController::class, 'index']);
        Route::post('etapas', [EtapaController::class, 'store']);
        Route::put('etapas/{id}', [EtapaController::class, 'update']);
        Route::delete('etapas/{id}', [EtapaController::class, 'destroy']);
        Route::put('etapas/{etapaId}/swap', [EtapaController::class, 'swap']);
    });

    Route::prefix('etapas/{etapaId}')->group(function () {
        Route::get('contatos', [ContatoController::class, 'index']);
        Route::post('contatos', [ContatoController::class, 'store']);
        Route::get('contatos/{contatoId}', [ContatoController::class, 'show']);
        Route::put('contatos/{contatoId}', [ContatoController::class, 'update']);
        Route::delete('contatos/{contatoId}', [ContatoController::class, 'destroy']);
        Route::put('contatos/{contatoId}/swap', [ContatoController::class, 'swap']);
        Route::put('contatos/{contatoId}/swap-phase', [ContatoController::class, 'swapPhase']);
        Route::post('contatos/import', [ContatoController::class, 'importCsv']);
    });
});

Route::apiResource('register-user', UserController::class);

Route::post('forget-password', [EmailController::class, 'sendPasswordChange'])->middleware('guest')->name('forget_password');
Route::post('reset-password', [EmailController::class, 'resetPassword'])->middleware('guest')->name('password.update');

Route::middleware('signed')->group(function () {
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
});
