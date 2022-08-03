<?php

namespace App\Http\Controllers\Web\Journal;

use App\Http\Controllers\Controller;
use App\Models\JournalDocument;
use App\Models\JournalTopic;
use Illuminate\Http\Request;

class JournalDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = JournalDocument::all();
        return view('admin.study.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $journalTopic = JournalTopic::all();
        return view('admin.departement.add')->with(compact('journalTopic'));
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
            'url' => 'required',
            'year' => 'required',
        ]);

        $pdf = $request->file('url');
        $pdf_name = strtolower($request->document_name)."-file-journal.".$pdf->getClientOriginalExtension();

        try {
            JournalDocument::create([
                'journal_topics_id' => $request->journal_topics_id,
                'title' => $request->title,
                'author' => $request->author,
                'abstract' => $request->abstract,
                'url' => $pdf_name,
                'year' => $request->year,
            ]);

            $pdf->move('files/journal/',$pdf_name);

            return redirect()->route('departements.index');

        } catch (\Throwable $th) {
            return $th;
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
            $update=[
                'journal_topics_id' => $request->journal_topics_id,
                'title' => $request->title,
                'author' => $request->author,
                'abstract' => $request->abstract,
                'year' => $request->year,
            ];

            if($request->file('url') !== NULL){
                $pdf = $request->file('url');
                $pdf_name = strtolower($request->title)."-files-thesis.".$pdf->getClientOriginalExtension();
                $update = [
                    'url' => $pdf_name,
                ];
                //move digunakan untuk memindahkan file ke folder public lalu dilanjutkan ke folder img/internalResearch/thumbnail
                $pdf->move('files/journal/',$pdf_name);
            }

            JournalDocument::find($id)->update($update);
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
            $data = JournalDocument::find($id);
            unlink('files/journal/'.$data['url']);
            $data = JournalDocument::destroy($id);
            return redirect()->route('admin.departements.index');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
