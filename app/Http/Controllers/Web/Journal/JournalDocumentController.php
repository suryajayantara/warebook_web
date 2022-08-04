<?php

namespace App\Http\Controllers\Web\Journal;

use App\Http\Controllers\Controller;
use App\Models\JournalDocument;
use App\Models\JournalTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = JournalDocument::where('id', $id)->with('User')->first();
        return view('journal.document.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $journal_id = $id;
        return view('journal.document.add', compact('journal_id'));
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
            'journal_topics_id' => 'required',
            'title' => 'required',
            'author' => 'required',
            'abstract' => 'required',
            'tags' => 'required',
            'year' => 'required',
            'document' => 'required',
        ]);

        $file_name = rand().date('YmdHis');
        $document_url = $file_name.'.'.$request->file('document')->extension();
        $request->file('document')->storeAs('document/journal', $document_url, 'public');

        try {
            JournalDocument::create([
                'users_id' => Auth::user()->id,
                'journal_topics_id' => $request->journal_topics_id,
                'title' => $request->title,
                'author' => $request->author,
                'abstract' => $request->abstract,
                'year' => $request->year,
                'tags' => $request->tags,
                'doi' => $request->doi,
                'original_url' => $request->original_url,
                'document_url' => $document_url,
            ]);
            return redirect('journalTopics/index/'.$request->journal_topics_id);

        } catch (\Throwable $th) {
            var_dump($th) ;
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
        $journalTopic = JournalTopic::all();
        return view('admin.departement.edit')->with(compact('journalTopic'));
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
        try {
            JournalDocument::find($id)->update([
                'journal_topics_id' => $request->journal_topics_id,
                'title' => $request->title,
                'author' => $request->author,
                'abstract' => $request->abstract,
                'year' => $request->year,
            ]);
            return redirect()->route('departements.index');

        } catch (\Throwable $th) {
            return $th;
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
            JournalDocument::find($id)->delete();
            return redirect()->route('admin.departements.index');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
