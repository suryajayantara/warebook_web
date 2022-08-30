<?php

namespace App\Http\Controllers\Web\Admin\Journal;

use App\Http\Controllers\Controller;
use App\Models\JournalDocument;
use App\Models\JournalTopic;
use App\Models\JournalType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = JournalTopic::paginate(6);
        return view('admin.journal.index', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.journal.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        try {
            JournalTopic::create([
                'users_id' => Auth::user()->id,
                'subject' => $request->subject,
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect()->route('manageJournal.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data = JournalTopic::where('title', 'LIKE', '%' . $request->search . '%')->orWhere('subject', 'LIKE', '%' . $request->search . '%')->paginate(6);
        return view('admin.creativity.index',   compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = JournalTopic::find($id);
        return view('admin.journal.edit')->with(compact('data'));
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
        $request->validate([
            'subject' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);


        try {
            JournalTopic::where('id', $id)->update([
                'subject' => $request->subject,
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect()->route('manageJournal.index');
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = JournalTopic::destroy($id);
            return redirect()->route('manageJournal.index');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
