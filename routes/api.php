<?php

use Illuminate\Http\Request;
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

Route::post('/issue-token', [\App\Http\Controllers\AuthController::class, 'issueToken']);
Route::post('/register', [\App\Http\Controllers\UserController::class, 'store']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/me', function (Request $request) {
        return $request->user();
    });

    Route::get('/pix-transfers', [\App\Http\Controllers\PixTransferController::class, 'index']);
    Route::post('/pix-transfers', [\App\Http\Controllers\PixTransferController::class, 'store']);
    Route::get('/pix-transfers/{pixTransfer}', [\App\Http\Controllers\PixTransferController::class, 'show']);
});

