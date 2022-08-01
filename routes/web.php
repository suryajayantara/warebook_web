<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\InternalResearch\InternalResearchController;
use App\Http\Controllers\Web\Journal\JournalDocumentController;
use App\Http\Controllers\Web\Journal\JournalTopicController;
use App\Http\Controllers\Web\Journal\JournalTypeController;
use App\Http\Controllers\Web\Manage\DepartementController;
use App\Http\Controllers\Web\Manage\StudyController;
use App\Http\Controllers\Web\StudentCreativityProgram\StudentCreativityProgramController;
use App\Http\Controllers\Web\StudentCreativityProgram\StudentCreativityProgramTypeController;
use App\Http\Controllers\Web\Thesis\ThesisController;
use App\Http\Controllers\Web\Thesis\ThesisDocumentController;
use App\Http\Controllers\Web\User\RegisterController;
use App\Models\Thesis;
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

Route::get('/home', function(){
    return view('user.index');
});


Route::resource('departements',DepartementController::class);
Route::resource('studies',StudyController::class);
// Route::resource('register',RegisterController::class);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('home', HomeController::class);

Route::resource('journalDocument',JournalDocumentController::class);
Route::resource('journalTopic',JournalTopicController::class);
Route::resource('journalType',JournalTypeController::class);
Route::resource('thesis',ThesisController::class);
Route::resource('thesisDocument',ThesisDocumentController::class);
Route::resource('creativity',StudentCreativityProgramController::class);
Route::resource('creativityType',StudentCreativityProgramTypeController::class);
Route::resource('internalResearch',InternalResearchController::class);
