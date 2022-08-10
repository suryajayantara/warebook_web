<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\Student\RepositoryController as StudentRepository;
use App\Http\Controllers\Web\Lecture\RepositoryController as LectureRepository;

use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\User\UserController;

use App\Http\Controllers\Web\Lecture\InternalResearch\InternalResearchController;

use App\Http\Controllers\Web\Lecture\Journal\JournalDocumentController;
use App\Http\Controllers\Web\Lecture\Journal\JournalTopicController;

use App\Http\Controllers\Web\Admin\Manage\DepartementController;
use App\Http\Controllers\Web\Admin\Manage\StudyController;

use App\Http\Controllers\Web\Student\StudentCreativityProgram\StudentCreativityProgramController;

use App\Http\Controllers\Web\Student\Thesis\ThesisController;
use App\Http\Controllers\Web\Student\Thesis\ThesisDocumentController;
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

Auth::routes();
Route::resource('home', HomeController::class);


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Admin
Route::group(['middleware' => ['role:admin'],'prefix' => 'admin',],function(){
    Route::resource('dashboard', DashboardController::class);
    Route::resource('departements', DepartementController::class);
    Route::resource('studies', StudyController::class);
    Route::resource('users', UserController::class);
});

// student
route::group(['middleware' => ['role:student', 'auth'],'prefix' => 'mahasiswa'],function(){

    Route::resource('studentRepository', StudentRepository::class);


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


});

route::group(['middleware' => ['role:lecture'],'prefix' => 'dosen'],function(){

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('lectureRepository', LectureRepository::class);

    Route::resource('internalResearch', InternalResearchController::class);


    //Journal Route
    Route::get('journalTopic/index/{id}', [JournalTopicController::class, 'index']);
    Route::get('journalTopic/edit/{id}', [JournalTopicController::class, 'edit']);
    Route::post('journalTopic/update', [JournalTopicController::class, 'update']);

    Route::get('journalDocument/create/{id}', [JournalDocumentController::class, 'create']);
    Route::get('journalDocument/index/{id}', [JournalDocumentController::class, 'index']);
    Route::post('journalDocument/update', [JournalDocumentController::class, 'update']);

    Route::resource('journalDocument', JournalDocumentController::class);
    Route::resource('journalTopic', JournalTopicController::class);

});