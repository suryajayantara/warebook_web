<?php

namespace App\Http\Controllers\Web\Lecture;

use App\Http\Controllers\Controller;
use App\Models\InternalResearch;
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
        $internal = InternalResearch::orderBy('id', 'DESC')->paginate(5);
        $topic = JournalTopic::orderBy('id', 'DESC')->paginate(5);

        $paginate = '';
        $paginate = $thesis;
        if ($creativity->total() > $paginate->total()) {
            $paginate = $creativity;
        }
        if ($journal->total() > $paginate->total()) {
            $paginate = $journal;
        }
        if ($internal->total() > $paginate->total()) {
            $paginate = $internal;
        }
        if ($topic->total() > $paginate->total()) {
            $paginate = $topic;
        }

        return view('user.lecture.index', compact('thesis', 'topic', 'creativity', 'journal', 'internal', 'paginate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $thesis = Thesis::where('id', 'a')->paginate(4);
        $creativity = StudentCreativityProgram::where('id', 'a')->paginate(4);
        $journal = JournalDocument::where('id', 'a')->paginate(4);
        $internal = InternalResearch::where('id', 'a')->paginate(4);
        $topic = JournalTopic::where('id', 'a')->paginate(4);

        $type = $request->type;
        $year = $request->year;
        $pagination = '';


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
            } elseif ($type == 'internal') {
                $internal = InternalResearch::orderBy('id', 'DESC')
                    ->where(function ($query) use ($search) {
                        $query->where('title', 'LIKE', '%' . $search . '%');
                        $query->orWhere('abstract', 'LIKE', '%' . $search . '%');
                        $query->orWhere('team_member', 'LIKE', '%' . $search . '%');
                        $query->orWhere('budget', 'LIKE', '%' . $search . '%');
                        $query->orWhere('project_started_at', 'LIKE', '%' . $search . '%');
                    });
                if (!empty($year)) {
                    $internal->where('project_started_at', 'LIKE', '%' . $year . '%');
                }
                $internal = $internal->paginate(4)->withQueryString();
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
            $internal = InternalResearch::orderBy('id', 'DESC')
                ->where(function ($query) use ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%');
                    $query->orWhere('abstract', 'LIKE', '%' . $search . '%');
                    $query->orWhere('team_member', 'LIKE', '%' . $search . '%');
                    $query->orWhere('budget', 'LIKE', '%' . $search . '%');
                    $query->orWhere('project_started_at', 'LIKE', '%' . $search . '%');
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
                $internal->where('project_started_at', 'LIKE', '%' . $year . '%');
            }
            $thesis = $thesis->paginate(4)->withQueryString();
            $journal = $journal->paginate(4)->withQueryString();
            $creativity = $creativity->paginate(4)->withQueryString();
            $internal = $internal->paginate(4)->withQueryString();
            $topic = $topic->paginate(4)->withQueryString();
        }

        $pagination = '';
        $pagination = $thesis;
        if ($creativity->total() > $pagination->total()) {
            $pagination = $creativity;
        }
        if ($journal->total() > $pagination->total()) {
            $pagination = $journal;
        }
        if ($internal->total() > $pagination->total()) {
            $pagination = $internal;
        }
        if ($topic->total() > $pagination->total()) {
            $pagination = $topic;
        }

        return view('user.lecture.search', compact('thesis', 'topic', 'creativity', 'journal', 'year', 'type', 'search', 'pagination'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

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
