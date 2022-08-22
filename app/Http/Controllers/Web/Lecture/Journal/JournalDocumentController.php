<?php

namespace App\Http\Controllers\Web\Lecture\Journal;

use App\Http\Controllers\Controller;
use App\Models\JournalDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JournalDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $journal_id = $request->id;
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


        $title = str_replace(' ', '_', $request->title);
        $document_url =  Auth::user()->id . date('dmY') . $title . '.' . $request->file('document')->extension();
        $request->file('document')->storeAs('journalDocument/', $document_url, 'public');
        $document_url = 'storage/journalDocument/' . $document_url;

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
            return redirect()->route('journalTopic.show', $request->journal_topics_id);
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
        $data = JournalDocument::where('id', $id)->first();
        return view('journal.document.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $journal_document = JournalDocument::find($id);
        return view('journal/document/edit')->with(compact('journal_document'));
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
            'title' => 'required',
            'author' => 'required',
            'abstract' => 'required',
            'tags' => 'required',
            'year' => 'required',
        ]);

        $old_journal = JournalDocument::find($request->journal_document_id);
        $document_url = $old_journal->document_url;
        if ($request->hasFile('document')) {
            Storage::disk('public')->delete(str_replace('storage/', '', $old_journal->document_url));


            $title = str_replace(' ', '_', $request->title);
            $document_url =  Auth::user()->id . date('dmY') . $title . '.' . $request->file('document')->extension();
            $request->file('document')->storeAs('journalDocument/', $document_url, 'public');
            $document_url = 'storage/journalDocument/' . $document_url;
        }

        try {
            JournalDocument::find($old_journal->id)->update([
                'title' => $request->title,
                'author' => $request->author,
                'tags' => $request->tags,
                'doi' => $request->doi,
                'original_url' => $request->original_url,
                'abstract' => $request->abstract,
                'year' => $request->year,
                'tags' => $request->tags,
                'doi' => $request->doi,
                'original_url' => $request->original_url,
                'document_url' => $document_url
            ]);
            return redirect()->route('journalTopic.show', ['journalTopic' => $old_journal->journal_topics_id]);
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
            $data = JournalDocument::find($id);
            Storage::disk('public')->delete(str_replace('storage/', '', $data->document_url));
            JournalDocument::destroy($id);

            return redirect()->route('journalTopic.show', ['journalTopic' => $data->journal_topics_id]);
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
