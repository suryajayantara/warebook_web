<?php

namespace App\Http\Controllers\Web\Student;

use App\Http\Controllers\Controller;
use App\Models\InternalResearch;
use App\Models\JournalDocument;
use App\Models\JournalTopic;
use App\Models\StudentCreativityProgram;
use App\Models\Thesis;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RepositoryController extends Controller
{

    public function index()
    {
        $thesis = Thesis::where('users_id', Auth::user()->id)->paginate(5);
        $creativity = StudentCreativityProgram::where('users_id', Auth::user()->id)->paginate(5);    
            
        return view('user.repository.index', compact('thesis', 'creativity'));

        
    }

    public function create()
    {
        return view('user.repository.add');
    }
}
