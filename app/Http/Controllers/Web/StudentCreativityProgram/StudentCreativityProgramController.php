<?php

namespace App\Http\Controllers\Web\StudentCreativityProgram;

use App\Http\Controllers\Controller;
use App\Models\StudentCreativityProgram;
use App\Models\StudentCreativityProgramType;
use Illuminate\Http\Request;

class StudentCreativityProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = StudentCreativityProgram::all();
        return view('admin.study.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departement.add');
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
            'creativity_type' => 'required',
            'aliases' => 'required',
            'title' => 'required',
            'abstract' => 'required',
            'year' => 'required',
            'thumbnail_url' => 'required',
            'supervisor' => 'required',
            'document_url' => 'required'
        ]);

        //request untuk menguload dalam bentuk file
        $document = $request->file('document_url');

        //request untuk mengubah nama file berdasarkan judul atau title internal research pada strtolower($request->title)
        //selanjutnya ditambah nama -img-thumbnail dan tambahan format asli pada file tersebut seperti .pdf, .png dll
        //getClientOriginalExtension digunakan untuk mencari format asli pada file
        $document_name = strtolower($request->title)."-file-document.".$document->getClientOriginalExtension();

        try {
            StudentCreativityProgram::create([
                'creativity_type' => $request->creativity_type,
                'aliases' => $request->aliases,
                'title' => $request->title,
                'abstract' => $request->abstract,
                'year' => $request->year,
                'supervisor' => $request->supervisor,
                'document_url' => $request->document_url
            ]);

            //move digunakan untuk memindahkan file ke folder public lalu dilanjutkan ke folder yang telah ditentukan
            $document->move('files/creativity/',$document_name);

            return redirect()->route('departements.index');

        } catch (\Throwable $th) {
            // return $th;
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
        $creativity = StudentCreativityProgram::find($id);
        return view('admin.departement.edit')->with(compact('creativity'));
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
            $data = StudentCreativityProgram::find($id);
            $update=[
                'creativity_type' => $request->creativity_type,
                'aliases' => $request->aliases,
                'title' => $request->title,
                'abstract' => $request->abstract,
                'year' => $request->year,
                'supervisor' => $request->supervisor,
            ];

            if($request->file('document_url') !== NULL){
                $document = $request->file('document_url');
                $document_name = strtolower($request->title)."-file-document.".$document->getClientOriginalExtension();
                $update = [
                    'document_url' => $document_name,
                ];

                unlink('files/creativity/'.$data['document_url']);
                $document->move('files/creativity/',$document_name);
            }

            StudentCreativityProgram::find($id)->update($update);

            return redirect()->route('departements.index');

        } catch (\Throwable $th) {
            // return $th;
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
            $data=StudentCreativityProgram::find($id);
            unlink('files/creativity/'.$data['document_url']);
            $data = StudentCreativityProgram::destroy($id);
            return redirect()->route('admin.departements.index');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
