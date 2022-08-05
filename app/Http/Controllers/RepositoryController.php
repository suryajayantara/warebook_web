<?php

namespace App\Http\Controllers;

use App\Models\InternalResearch;
use App\Models\JournalDocument;
use App\Models\JournalTopic;
use App\Models\StudentCreativityProgram;
use App\Models\Thesis;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Middlewares\RoleMiddleware;

class RepositoryController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->get();

        if(Auth::user()->hasRole('student')){
            $thesis = Thesis::where('users_id', Auth::user()->id)->get();
            $creativity = StudentCreativityProgram::where('users_id', Auth::user()->id)->get();    
            return view('user.repository.index', compact('thesis', 'creativity'));

        }else {
            $topic = JournalTopic::where('users_id', Auth::user()->id)->get();
            $journal = JournalDocument::where('users_id', Auth::user()->id)->get();
            $internalresearch = InternalResearch::where('users_id', Auth::user()->id)->get();

            // var_dump($topic);
            return view('user.repository.index', compact('journal', 'topic', 'internalresearch'));
        }
       
        
    }

    public function create()
    {
        return view('user.repository.add');
    }
}
