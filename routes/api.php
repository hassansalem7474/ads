<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AdvertiserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::resource('advertisers',AdvertiserController::class);
Route::resource('categories',CategoryController::class);
Route::resource('ads',AdController::class);
Route::resource('tags',TagController::class);

Route::get('send-mail',[AdvertiserController::class , 'send_mail']);
Route::get('filter',[AdController::class , 'filter']);