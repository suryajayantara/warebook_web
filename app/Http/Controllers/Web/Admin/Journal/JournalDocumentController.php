<?php

namespace App\Http\Controllers\Web\Admin\Journal;

use App\Http\Controllers\Controller;
use App\Models\JournalDocument;
use App\Models\JournalTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JournalDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = JournalDocument::paginate('6');
        return view('admin.journal.document.index', compact('data'));
    }

    public function create(Request $request)
    {
        $journal_id = $request->journal_topics_id;
        return view('admin.journal.document.add', compact('journal_id'));
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
        $data = JournalDocument::where('title', 'LIKE', '%' . $request->search . '%')->orWhere('tags', 'LIKE', '%' . $request->search . '%')->orWhere('author', 'LIKE', '%' . $request->search . '%')->orWhere('year', 'LIKE', '%' . $request->search . '%')->paginate(6);
        return view('admin.journal.document.index',   compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = JournalDocument::find($id);
        return view('admin.journal.document.edit', compact('data'));
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
            'title' => 'required',
            'author' => 'required',
            'abstract' => 'required',
            'tags' => 'required',
            'year' => 'required',
        ]);

        $old_journal = JournalDocument::find($id);
        // var_dump($old_journal);
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
                'abstract' => $request->abstract,
                'year' => $request->year,
                'doi' => $request->doi,
                'original_url' => $request->original_url,
                'document_url' => $document_url
            ]);
            return redirect()->route('manageJournalDoc.index');
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
            $data = JournalDocument::find($id);
            Storage::disk('public')->delete('document/journal/' . $data->document_url);
            JournalDocument::destroy($id);

            return redirect()->route('manageJournalDoc.index');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
