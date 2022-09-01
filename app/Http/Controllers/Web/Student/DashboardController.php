<?php

namespace App\Http\Controllers\Web\Student;

use App\Http\Controllers\Controller;
use App\Models\JournalDocument;
use App\Models\JournalTopic;
use App\Models\StudentCreativityProgram;
use App\Models\Thesis;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thesis = Thesis::orderBy('id', 'DESC')->paginate(5);
        $creativity = StudentCreativityProgram::orderBy('id', 'DESC')->paginate(5);
        $journal = JournalDocument::orderBy('id', 'DESC')->paginate(5);
        $topic = JournalTopic::orderBy('id', 'DESC')->paginate(5);
        return view('user.student.index', compact('thesis', 'topic', 'creativity', 'journal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo 'test';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $thesis = '';
        $creativity = '';
        $journal = '';

        $type = $request->type;
        $year = $request->year;

        $search = $request->search;
        // dd($year);
        if ($request->type) {
            if ($type == 'thesis') {
                $thesis = Thesis::orderBy('id', 'DESC')
                    ->where(function ($query) use ($search) {
                        $query->where('title', 'LIKE', '%' . $search . '%');
                        $query->orWhere('abstract', 'LIKE', '%' . $search . '%');
                        $query->orWhere('tags', 'LIKE', '%' . $search . '%');
                    });
                if (!empty($year)) {
                    $thesis->where('created_year', $year);
                }
                $thesis = $thesis->paginate(4)->withQueryString();
            } elseif ($type == 'pkm') {
                $creativity = StudentCreativityProgram::orderBy('id', 'DESC')
                    ->where(function ($query) use ($search) {
                        $query->where('title', 'LIKE', '%' . $search . '%');
                        $query->orWhere('abstract', 'LIKE', '%' . $search . '%');
                        $query->orWhere('creativity_type', 'LIKE', '%' . $search . '%');
                        $query->orWhere('aliases', 'LIKE', '%' . $search . '%');
                    });
                if (!empty($year)) {
                    $creativity->where('year', $year);
                }
                $creativity = $creativity->paginate(4)->withQueryString();
            } elseif ($type == 'journal') {
                $journal = JournalDocument::orderBy('id', 'DESC')
                    ->where(function ($query) use ($search) {
                        $query->where('title', 'LIKE', '%' . $search . '%');
                        $query->orWhere('abstract', 'LIKE', '%' . $search . '%');
                        $query->orWhere('author', 'LIKE', '%' . $search . '%');
                        $query->orWhere('tags', 'LIKE', '%' . $search . '%');
                    });
                if (!empty($year)) {
                    $journal->where('year', $year);
                }
                $journal = $journal->paginate(4)->withQueryString();
            } elseif ($type == 'topic') {
                $topic = JournalTopic::orderBy('id', 'DESC')
                    ->where(function ($query) use ($search) {
                        $query->where('title', 'LIKE', '%' . $search . '%');
                        $query->orWhere('description', 'LIKE', '%' . $search . '%');
                        $query->orWhere('subject', 'LIKE', '%' . $search . '%');
                    });
                $topic = $topic->paginate(4)->withQueryString();
            }
        } else {
            $thesis = Thesis::orderBy('id', 'DESC')
                ->where(function ($query) use ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%');
                    $query->orWhere('abstract', 'LIKE', '%' . $search . '%');
                    $query->orWhere('tags', 'LIKE', '%' . $search . '%');
                });
            $creativity = StudentCreativityProgram::orderBy('id', 'DESC')
                ->where(function ($query) use ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%');
                    $query->orWhere('abstract', 'LIKE', '%' . $search . '%');
                    $query->orWhere('creativity_type', 'LIKE', '%' . $search . '%');
                    $query->orWhere('aliases', 'LIKE', '%' . $search . '%');
                });
            $journal = JournalDocument::orderBy('id', 'DESC')
                ->where(function ($query) use ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%');
                    $query->orWhere('abstract', 'LIKE', '%' . $search . '%');
                    $query->orWhere('author', 'LIKE', '%' . $search . '%');
                    $query->orWhere('tags', 'LIKE', '%' . $search . '%');
                });
            $topic = JournalTopic::orderBy('id', 'DESC')
                ->where(function ($query) use ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%');
                    $query->orWhere('description', 'LIKE', '%' . $search . '%');
                    $query->orWhere('subject', 'LIKE', '%' . $search . '%');
                });
            if (!empty($year)) {
                $creativity->where('year', $year);
                $journal->where('year', $year);
                $thesis->where('created_year', $year);
            }
            $thesis = $thesis->paginate(4)->withQueryString();
            $journal = $journal->paginate(4)->withQueryString();
            $creativity = $creativity->paginate(4)->withQueryString();
            $topic = $topic->paginate(4)->withQueryString();
        }

        $years = Thesis::select('created_year')->distinct()->orderBy('created_year', 'DESC')->get();

        return view('user.student.search', compact('thesis', 'topic', 'creativity', 'journal', 'year', 'type', 'years', 'search'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     echo 'tes';
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
