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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $thesis = Thesis::where('users_id', Auth::user()->id)->paginate(5);

        // var_dump($thesis);
        $creativity = StudentCreativityProgram::where('users_id', Auth::user()->id)->paginate(5);

        return view('user.repository.index', compact('thesis', 'creativity'));
    }

    public function create()
    {
        return view('user.repository.add');
    }
}
