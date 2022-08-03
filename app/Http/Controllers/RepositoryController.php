<?php

namespace App\Http\Controllers;

use App\Models\Thesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepositoryController extends Controller
{
    public function index()
    {
        $thesis = Thesis::where('users_id', Auth::user()->id)->get();
        return view('user.repository.index', compact('thesis'));
    }

    public function create()
    {
        return view('user.repository.add');
    }
}
