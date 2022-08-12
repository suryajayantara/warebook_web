<?php

namespace App\Http\Controllers\Web\Admin\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ThesisDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = ThesisDocument::paginate(5);
        return view('admin.thesis.document.index',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data = ThesisDocument::where('document_name', 'LIKE', '%'.$request->search.'%')->paginate(6);
        return view('admin.thesis.document.index',   compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ThesisDocument::find($id);
        return view('admin.thesis.document.edit', compact('data'));
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
        // var_dump($id);
        $data = ThesisDocument::find($id);
        $thesis = Thesis::find($data->thesis_id);

        $document_url = $data->document_url;

        if($request->hasFile('document')){
            Storage::disk('public')->delete(str_replace('storage/', '', $data->document_url));

            $title = str_replace(' ', '_', $request->document_name).str_replace(' ','_', $thesis->title);
            $document_url =  Auth::user()->id. date('dmY') . $title . '.'. $request->file('document')->extension();
            $request->file('document')->storeAs('thesisDocument/', $document_url, 'public');
            $document_url = 'storage/thesisDocument/'. $document_url;
        }


        try {
            ThesisDocument::where('id', $id)->update([
                'document_name' => $request->document_name,
                'document_url' => $document_url,
            ]);
            return redirect()->route('manageThesisDoc.index');

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
            $data = ThesisDocument::find($id);
            Storage::disk('public')->delete(str_replace('storage/', '', $data->document_url));
            ThesisDocument::destroy($id);
            return redirect('mahasiswa/thesis/'.$data->thesis_id);
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
