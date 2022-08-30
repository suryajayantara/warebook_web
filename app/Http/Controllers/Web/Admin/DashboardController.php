<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternalResearch;
use App\Models\JournalDocument;
use App\Models\StudentCreativityProgram;
use App\Models\Thesis;
use App\Models\UserDetail;
use Faker\Provider\cs_CZ\Company;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'thesis' => Thesis::count(),
            'creativity' => StudentCreativityProgram::count(),
            'journal' => JournalDocument::count(),
            'internal' => InternalResearch::count(),
            'user' => UserDetail::count()
        ];

        return view('admin.dashboard.index', compact('data'));
    }
}
