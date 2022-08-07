<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RepositoryController;
use App\Http\Controllers\Web\InternalResearch\InternalResearchController;
use App\Http\Controllers\Web\Journal\JournalDocumentController;
use App\Http\Controllers\Web\Journal\JournalTopicController;
use App\Http\Controllers\Web\Manage\DepartementController;
use App\Http\Controllers\Web\Manage\StudyController;
use App\Http\Controllers\Web\StudentCreativityProgram\StudentCreativityProgramController;
use App\Http\Controllers\Web\Thesis\ThesisController;
use App\Http\Controllers\Web\Thesis\ThesisDocumentController;
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

//

Route::get('/home', function () {
    return view('user.index');
});


Route::resource('departements', DepartementController::class);
Route::resource('studies', StudyController::class);
// Route::resource('register',RegisterController::class);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('home', HomeController::class);
Route::resource('repository', RepositoryController::class);

//Thesis Route
Route::get('thesis/create/{type}', [ThesisController::class, 'create']);
Route::get('thesis/{id}', [ThesisController::class, 'index']);
Route::resource('thesis', ThesisController::class);
Route::post('thesis/update', [ThesisController::class, 'update']);
Route::post('thesisDocument/create', [ThesisDocumentController::class, 'create']);
Route::post('thesisDocument/update', [ThesisDocumentController::class, 'update']);
Route::resource('thesisDocument', ThesisDocumentController::class);


//Journal Route
Route::get('journalTopic/index/{id}', [JournalTopicController::class, 'index']);
Route::get('journalTopic/edit/{id}', [JournalTopicController::class, 'edit']);
Route::post('journalTopic/update', [JournalTopicController::class, 'update']);

Route::get('journalDocument/create/{id}', [JournalDocumentController::class, 'create']);
Route::get('journalDocument/index/{id}', [JournalDocumentController::class, 'index']);
Route::post('journalDocument/update', [JournalDocumentController::class, 'update']);

Route::resource('journalDocument', JournalDocumentController::class);
Route::resource('journalTopic', JournalTopicController::class);


Route::resource('creativity', StudentCreativityProgramController::class);
Route::resource('internalResearch', InternalResearchController::class);
