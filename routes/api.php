<?php

use App\Http\Controllers\Api\Auth\UserController;

use App\Http\Controllers\Api\InternalResearch\InternalResearchServiceController;
use App\Http\Controllers\Api\Journal\JournalDocumentsServiceController;
use App\Http\Controllers\Api\Journal\JournalTopicsServiceController;
use App\Http\Controllers\Api\Manage\DepartementServiceController;
use App\Http\Controllers\Api\Manage\StudyServiceController;
use App\Http\Controllers\Api\StudentCreativityProgram\StudentCreativityProgramServiceController;
use App\Http\Controllers\Api\Thesis\ThesisDocumentServiceController;
use App\Http\Controllers\Api\Thesis\ThesisServiceController;
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


    Route::get('/getUser',[UserController::class,'getUser'])->middleware('auth:api');
    Route::post('/login', [UserController::class,'login']);
    Route::post('/register', [UserController::class,'register']);
    Route::get('/logout', [UserController::class,'logout'])->middleware('auth:api');

    //StudentCreativityProgram => Ade part
    //route untuk get all data, get one data by id, post data, put data and delete data PKM
    Route::prefix('creativity')->group(function(){
        Route::get('/',[StudentCreativityProgramServiceController::class,'getCreativity']);
        Route::get('/{id}', [StudentCreativityProgramServiceController::class,'getOneCreativity']);
        Route::post('/',[StudentCreativityProgramServiceController::class,'create']);
        Route::post('/{id}',[StudentCreativityProgramServiceController::class,'update']);
        Route::delete('/{id}',[StudentCreativityProgramServiceController::class,'destroy']);
    });

    // Thesis atau tugas akhir => Surje Part => Jangan diutak atik !
    // Cuma Surje dan tuhan yang tau arah route ini kemana
    // Kalau surje udah ga maintain code ini , berarti gaada yang tau route ini arahnya kemana
    // Baca baca aja dokumentasi dilaravel, sisanya ku serahkan kepadamu anak muda 🙏
    Route::prefix('thesis')->group(function(){
        Route::get('/',[ThesisServiceController::class,'getThesis']);
        Route::get('/{id}', [ThesisServiceController::class,'getOneThesis']);
        Route::post('/',[ThesisServiceController::class,'create']);
        Route::post('/{id}',[ThesisServiceController::class,'update']);
        Route::delete('/{id}',[ThesisServiceController::class,'destroy']);
    });

    //ThesisDocument => Ade part
    //route untuk get all data, get one data by id, post data, put data and delete data ThesisDocument
    Route::prefix('thesisDocument')->group(function(){
        Route::get('/',[ThesisDocumentServiceController::class,'getThesisDocument']);
        Route::get('/{id}', [ThesisDocumentServiceController::class,'getOneThesisDocument']);
        Route::post('/',[ThesisDocumentServiceController::class,'create']);
        Route::post('/{id}',[ThesisDocumentServiceController::class,'update']);
        Route::delete('/{id}',[ThesisDocumentServiceController::class,'destroy']);
    });

    //InternalResearch => Ade part
    //route untuk get all data, get one data by id, post data, put data and delete data InternalResearch
    Route::prefix('research')->group(function(){
        Route::get('/',[InternalResearchServiceController::class,'getResearch']);
        Route::get('/{id}', [InternalResearchServiceController::class,'getOneResearch']);
        Route::post('/',[InternalResearchServiceController::class,'create']);
        Route::post('/{id}',[InternalResearchServiceController::class,'update']);
        Route::delete('/{id}',[InternalResearchServiceController::class,'destroy']);
    });

    //Study => Ade part
    //route untuk get all data, get one data by id, post data, put data and delete data InternalResearch
    Route::prefix('study')->group(function(){
        Route::get('/',[StudyServiceController::class,'getStudy']);
        Route::get('/{id}', [StudyServiceController::class,'getOneStudy']);
        Route::get('/departement/{id}', [StudyServiceController::class,'getAllStudyByDepartement']);
        Route::post('/',[StudyServiceController::class,'create']);
        Route::post('/{id}',[StudyServiceController::class,'update']);
        Route::delete('/{id}',[StudyServiceController::class,'destroy']);
    });

    //Departement => Ade part
    //route untuk get all data, get one data by id, post data, put data and delete data InternalResearch
    Route::prefix('departement')->group(function(){
        Route::get('/',[DepartementServiceController::class,'getDepartement']);
        Route::get('/{id}', [DepartementServiceController::class,'getOneDepartement']);
        Route::post('/',[DepartementServiceController::class,'create']);
        Route::post('/{id}',[DepartementServiceController::class,'update']);
        Route::delete('/{id}',[DepartementServiceController::class,'destroy']);
    });

    //Journal Document => Ade part
    //route untuk get all data, get one data by id, post data, put data and delete data JournalDocument
    Route::prefix('journalDocument')->group(function(){
        Route::get('/',[JournalDocumentsServiceController::class,'getJournalDocument']);
        Route::get('/{id}', [JournalDocumentsServiceController::class,'getOneJournalDocument']);
        Route::post('/',[JournalDocumentsServiceController::class,'create']);
        Route::post('/{id}',[JournalDocumentsServiceController::class,'update']);
        Route::delete('/{id}',[JournalDocumentsServiceController::class,'destroy']);
    });

    //Journal Topic => Ade part
    //route untuk get all data, get one data by id, post data, put data and delete data JournalTopic
    Route::prefix('journalTopic')->group(function(){
        Route::get('/',[JournalTopicsServiceController::class,'getJournalTopic']);
        Route::get('/{id}', [JournalTopicsServiceController::class,'getOneJournalTopic']);
        Route::post('/',[JournalTopicsServiceController::class,'create']);
        Route::post('/{id}',[JournalTopicsServiceController::class,'update']);
        Route::delete('/{id}',[JournalTopicsServiceController::class,'destroy']);
    });


});

