<?php

namespace App\Http\Controllers\Web\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.study.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $thesis_id = $request->thesis_id;
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
        $request->validate([
            'thesis_id' => 'required',
            'document_name' => 'required',
            'document' => 'required',
        ]);

        $file_name = rand().date('YmdHis');
        $url = $file_name.'.'.$request->file('document')->extension();
        $request->file('document')->storeAs('document/thesis', $url, 'public');

        //fungsi upload file by ade
        //$pdf = $request->file('url');
        //$pdf_name = strtolower($request->document_name)."-file-thesis.".$pdf->getClientOriginalExtension();


        try {
            ThesisDocument::create([
                'thesis_id' => $request->thesis_id,
                'document_name' => $request->document_name,
                'url' => $url,
            ]);
            return redirect('thesis/'.$request->thesis_id);

            //fungsi upload file by ade
                //'document_name' => $pdf_name,
                //'url' => $pdf_name,
            //]);

            //$pdf->move('files/thesis/',$pdf_name);

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
        $thesisDocument = ThesisDocument::find($id);
        $thesis = Thesis::all();
        return view('admin.departement.edit')->with(compact('thesisDocument','thesis'));
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
            $data = ThesisDocument::find($id);
            $update = [
                'thesis_id' => $request->thesis_id,
                'document_name' => $request->document_name,
                'url' => $request->url,
            ];

            if($request->file('url') !== NULL){
                $pdf = $request->file('url');
                $pdf_name = strtolower($request->title)."-files-thesis.".$pdf->getClientOriginalExtension();
                $update = [
                    'url' => $pdf_name,
                ];
                unlink('files/thesis/'.$data['url']);
                //move digunakan untuk memindahkan file ke folder public lalu dilanjutkan ke folder img/internalResearch/thumbnail
                $pdf->move('files/thesis/',$pdf_name);
            }

            ThesisDocument::find($id)->update($update);

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
            $data = Thesis::find($id);
            unlink('files/thesis/'.$data['url']);
            $data = Thesis::destroy($id);
            return redirect()->route('admin.departements.index');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
