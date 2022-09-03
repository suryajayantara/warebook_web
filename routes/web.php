<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\User\ChangePasswordController;
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
use App\Http\Controllers\Web\Admin\ReportController;
use App\Http\Controllers\Web\Lecture\DashboardController as LectureDashboardController;
use App\Http\Controllers\Web\Lecture\StudentCreativityProgram\StudentCreativityProgramController as lectureStudentCreativityProgramController;
use App\Http\Controllers\Web\Lecture\Thesis\ThesisController as lectureThesisController;
use App\Http\Controllers\Web\Lecture\Thesis\ThesisDocumentController as lectureThesisDocumentController;
use App\Http\Controllers\Web\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Web\Student\Journal\JournalDocumentController as StudentJournalDocumentController;
use App\Http\Controllers\Web\Student\Journal\JournalTopicController as StudentJournalController;
use App\Http\Controllers\Web\Student\StudentCreativityProgram\StudentCreativityProgramController;
use App\Http\Controllers\Web\Student\Thesis\ThesisController;
use App\Http\Controllers\Web\Student\Thesis\ThesisDocumentController;
use App\Http\Controllers\Web\User\RegisterController;
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
    return redirect()->route('login');
});
Auth::routes();
Auth::routes(['verify' => true]);
Route::resource('register', RegisterController::class);
Route::group(['middleware' => ['auth']], function () {
    Route::resource('home', HomeController::class);
    Route::resource('user', UserDetailController::class);
    Route::resource('changepassword', ChangePasswordController::class);
});
Route::group(['middleware' => ['role:admin', 'auth'], 'prefix' => 'admin',], function () {
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
    Route::resource('report', ReportController::class);
});
route::group(['middleware' => ['role:student', 'auth'], 'prefix' => 'mahasiswa'], function () {
    Route::resource('studentRepository', StudentRepository::class);
    Route::resource('thesis', ThesisController::class);
    Route::resource('thesisDocument', ThesisDocumentController::class);
    Route::resource('creativity', StudentCreativityProgramController::class);
    Route::resource('studentJournalTopic', StudentJournalController::class);
    Route::resource('studentJournalDocument', StudentJournalDocumentController::class);
    Route::resource('studentDashboard', StudentDashboardController::class);
});
route::group(['middleware' => ['role:lecture'], 'prefix' => 'dosen'], function () {
    Route::resource('lectureRepository', LectureRepository::class);
    Route::resource('internalResearch', InternalResearchController::class);
    Route::resource('journalDocument', JournalDocumentController::class);
    Route::resource('journalTopic', JournalTopicController::class);
    Route::resource('lectureDashboard', LectureDashboardController::class);
    Route::resource('lectureCreativity', lectureStudentCreativityProgramController::class);
    Route::resource('lectureThesis', lectureThesisController::class);
    Route::resource('lectureThesisDocument', lectureThesisDocumentController::class);
});
