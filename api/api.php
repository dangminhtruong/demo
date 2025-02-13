<?php

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

Route::group(['prefix' => env('API_VERSION')], function () {
    Route::group(['prefix' => 'candidate'], function () {
        Route::post('apply', [App\Http\Controllers\CandidateController::class, 'apply']);
        Route::get('list', [App\Http\Controllers\CandidateController::class, 'getCandidatesByStatus']);
        Route::get('{id}', [App\Http\Controllers\CandidateController::class, 'getCandidateDetails']);
    });
});
