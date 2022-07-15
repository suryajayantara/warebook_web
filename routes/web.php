<?php

use App\Http\Controllers\Web\Manage\DepartementController;
use App\Http\Controllers\Web\Manage\StudyController;
use App\Http\Controllers\Web\User\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('register.index');
});


Route::resource('departements',DepartementController::class);
Route::resource('studies',StudyController::class);
Route::resource('register',RegisterController::class);
