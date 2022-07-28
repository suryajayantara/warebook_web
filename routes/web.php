<?php

use App\Http\Controllers\Api\Thesis\ThesisController;
use App\Http\Controllers\Web\Manage\DepartementController;
use App\Http\Controllers\Web\Manage\StudyController;
use App\Http\Controllers\Web\Thesis\ThesisController as ThesisThesisController;
use App\Http\Controllers\Web\Thesis\ThesisDocumentController;
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
    return view('index');
});

Route::get('/thesis/repository', function () {
    return view('thesis.repository');
});


Route::get('/create', function () {
    return view('thesis.create');
});

Route::get('/journal', function () {
    return view('journal.document');
});

Route::get('/repository', function(){
    return view('user.student.index');
});
Route::get('/home', function(){
    return view('user.index');
});

Route::get('/thesis', function(){
    return view('thesis.index');
});


Route::resource('departements',DepartementController::class);
Route::resource('studies',StudyController::class);
Route::resource('register',RegisterController::class);
Route::resource('thesis', ThesisThesisController:: class);
Route::resource('thesisdocument',ThesisDocumentController::class);
