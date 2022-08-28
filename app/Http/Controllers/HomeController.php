<?php

namespace App\Http\Controllers;

use App\Models\JournalTopic;
use App\Models\Thesis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {

            return redirect()->route('dashboard.index');
            // return view('admin.dashboard.index');

        } elseif (Auth::user()->hasRole('student')) {

            return redirect()->route('studentDashboard.index');

            // return view('user.index', compact('thesis'));
        } else {
            return redirect()->route('lectureDashboard.index');

            // return view('user.index', compact('journal'));
        }
    }
}
