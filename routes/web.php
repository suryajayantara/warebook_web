<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\Student\RepositoryController as StudentRepository;
use App\Http\Controllers\Web\Lecture\RepositoryController as LectureRepository;

use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\User\UserController;

use App\Http\Controllers\Web\Lecture\InternalResearch\InternalResearchController;

use App\Http\Controllers\Web\Lecture\Journal\JournalDocumentController;
use App\Http\Controllers\Web\Lecture\Journal\JournalTopicController;

use App\Http\Controllers\Web\Admin\Journal\JournalDocumentController as ManageJournalDokumenController;
use App\Http\Controllers\Web\Admin\Journal\JournalTopicController as ManageJournalController;

use App\Http\Controllers\Web\Admin\Manage\DepartementController;
use App\Http\Controllers\Web\Admin\Manage\StudyController;

use App\Http\Controllers\Web\Admin\Thesis\ThesisController as AdminThesisController;
use App\Http\Controllers\Web\Admin\Thesis\ThesisDocumentController as AdminThesisDocController;
use App\Http\Controllers\Web\Admin\StudentCreativityProgram\StudentCreativityProgramController as ManageCreativityController;

use App\Http\Controllers\Web\Admin\InternalResearch\InternalResearchController as ManageInternalResearchController;

use App\Http\Controllers\Web\Student\StudentCreativityProgram\StudentCreativityProgramController;

use App\Http\Controllers\Web\Student\Thesis\ThesisController;
use App\Http\Controllers\Web\Student\Thesis\ThesisDocumentController;
use App\Http\Controllers\Web\User\UserDetailController;
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
Route::resource('user', UserDetailController::class);


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Admin
Route::group(['middleware' => ['role:admin'],'prefix' => 'admin',],function(){
    Route::resource('dashboard', DashboardController::class);
    Route::resource('departements', DepartementController::class);
    Route::resource('studies', StudyController::class);
    Route::resource('users', UserController::class);
    Route::resource('manageThesis', AdminThesisController::class);
    Route::resource('manageThesisDoc', AdminThesisDocController::class);
    Route::resource('manageCreativity', ManageCreativityController::class);

    Route::resource('manageJournal', ManageJournalController::class);
    Route::resource('manageJournalDoc', ManageJournalDokumenController::class);

    Route::resource('manageInternalResearch', ManageInternalResearchController::class);
});

// student
route::group(['middleware' => ['role:student', 'auth'],'prefix' => 'mahasiswa'],function(){

    Route::resource('studentRepository', StudentRepository::class);
    Route::resource('thesis', ThesisController::class);
    Route::resource('thesisDocument', ThesisDocumentController::class);
    Route::resource('creativity', StudentCreativityProgramController::class);


});

route::group(['middleware' => ['role:lecture'],'prefix' => 'dosen'],function(){

    Route::resource('lectureRepository', LectureRepository::class);
    Route::resource('internalResearch', InternalResearchController::class);
    Route::resource('journalDocument', JournalDocumentController::class);
    Route::resource('journalTopic', JournalTopicController::class);

});
