<?php

<<<<<<< HEAD
use App\Http\Controllers\LoginController;
=======
use App\Http\Controllers\Api\Thesis\ThesisController;
use App\Models\Thesis;
>>>>>>> 99fa4374805a19bb8bcd3e6afd25a3c535aaf168
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

<<<<<<< HEAD
Route::group(['prefix' => 'v1'],function(){
    Route::post('login',[LoginController::class,'login']);
    Route::post('register',[LoginController::class,'register']);
    Route::get('logout',[LoginController::class,'logout'])->middleware('auth:api');
});
=======

Route::get('/thesis',[ThesisController::class,'getAllThesis']);
>>>>>>> 99fa4374805a19bb8bcd3e6afd25a3c535aaf168
