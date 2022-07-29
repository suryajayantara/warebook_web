<?php

use App\Http\Controllers\Api\Auth\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Api\Thesis\ThesisServiceController;
use App\Models\Thesis;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'],function(){

    Route::get('/getUser',[UserController::class,'getUser'])->middleware('auth:api');
    Route::post('/login', [UserController::class,'login']);
    Route::post('/register', [UserController::class,'register']);
    Route::get('/logout', [UserController::class,'logout'])->middleware('auth:api');

});

Route::get('/thesis',[ThesisServiceController::class,'getAllThesis']);
