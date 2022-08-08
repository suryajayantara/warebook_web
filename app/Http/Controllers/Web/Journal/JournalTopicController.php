<?php

namespace App\Http\Controllers\Web\Journal;

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
    public function index($id)
    {
        $data = JournalTopic::where('id', $id)  ->first();
        $document = JournalDocument::where('journal_topics_id', $id)->with('User')->get();
        // var_dump($data);
        return view('journal.index',compact('data', 'document'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('journal.add');
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
            'users_id' => 'required',
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

            return redirect()->route('departements.index');

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $journal = JournalTopic::find($id);
        return view('journal.edit')->with(compact('journal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        try {
            JournalTopic::where('id', $request->id)->update([
                'subject' => $request->subject,
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return redirect('/journalTopic/index/'. $request->id);

        } catch (\Throwable $th) {
            throw $th;
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
            return redirect()->route('repository.index');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
