<?php

namespace App\Http\Controllers\Web\Student\Thesis;

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
        $data = ThesisDocument::all();
        return view('admin.study.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $thesis_id = $request->thesi;
        return view('thesis.document.add', compact('thesis_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Validation
        $request->validate([
            'thesis_id' => 'required',
            'document_name' => 'required',
            'document' => 'required',
        ]);

        //Upload Document

        $thesis = Thesis::where('users_id', Auth::user()->id)->paginate(1);

        // var_dump($thesis);
        foreach ($thesis as $item) {

            if ($item->id == $request->thesis_id) {
                // var_dump($item);
                $thesis = Thesis::find($request->thesis_id);

                $title = str_replace(' ', '_', $request->document_name) . str_replace(' ', '_', $thesis->title);
                $document_url =  Auth::user()->id . date('dmY') . $title . '.' . $request->file('document')->extension();
                $request->file('document')->storeAs('thesisDocument/', $document_url, 'public');
                $document_url = 'storage/thesisDocument/' . $document_url;

                //Insert data
                try {
                    ThesisDocument::create([
                        'thesis_id' => $request->thesis_id,
                        'document_name' => $request->document_name,
                        'document_url' => $document_url,
                    ]);

                    //redirect to thesis
                    return redirect()->route('thesis.show', ['thesi' => $request->thesis_id]);
                    //$pdf->move('files/thesis/',$pdf_name);

                } catch (\Throwable $th) {
                    throw $th;
                }
            } else {
                return redirect()->to('studentRepository.index');
            }
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
        $thesisDocument = ThesisDocument::find($id);
        return view('thesis.document.edit')->with(compact('thesisDocument'));
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

        if ($request->hasFile('document')) {
            Storage::disk('public')->delete(str_replace('storage/', '', $data->document_url));

            $title = str_replace(' ', '_', $request->document_name) . str_replace(' ', '_', $thesis->title);
            $document_url =  Auth::user()->id . date('dmY') . $title . '.' . $request->file('document')->extension();
            $request->file('document')->storeAs('thesisDocument/', $document_url, 'public');
            $document_url = 'storage/thesisDocument/' . $document_url;
        }


        try {
            ThesisDocument::where('id', $id)->update([
                'document_name' => $request->document_name,
                'document_url' => $document_url,
            ]);
            return redirect('/mahasiswa/thesis/' . $data->thesis_id);
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
            return redirect('mahasiswa/thesis/' . $data->thesis_id);
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
