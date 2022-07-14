<?php

use App\Http\Controllers\Api\Thesis\ThesisController;
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

Route::prefix('v1')->group(function(){

    // Thesis atau tugas akhir => Surje Part => Jangan diutak atik !
    // Cuma Surje dan tuhan yang tau arah route ini kemana
    // Kalau surje udah ga maintain code ini , berarti gaada yang tau route ini arahnya kemana
    // Baca baca aja dokumentasi dilaravel, sisanya ku serahkan kepadamu anak muda 🙏
    Route::prefix('thesis')->group(function(){
        Route::get('/',[ThesisController::class,'getThesis']);
        Route::get('/{id}', [ThesisController::class,'getOneThesis']);
        Route::post('/',[ThesisController::class,'create']);
        Route::put('/{id}',[ThesisController::class,'update']);
        Route::delete('/{id}',[ThesisController::class,'destroy']);
    });

    // InternalResearch => Ade Part



});
