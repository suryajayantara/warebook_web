<?php

namespace App\Http\Controllers\Web\Lecture;

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
        $topic = JournalTopic::where('users_id', Auth::user()->id)->paginate(5);
        $journal = JournalDocument::where('users_id', Auth::user()->id)->paginate(5);
        $internalresearch = InternalResearch::where('users_id', Auth::user()->id)->paginate(5);

        return view('user.repository.index', compact('journal', 'topic', 'internalresearch'));
       
        
    }

    public function create()
    {
        return view('user.repository.add');
    }
}
