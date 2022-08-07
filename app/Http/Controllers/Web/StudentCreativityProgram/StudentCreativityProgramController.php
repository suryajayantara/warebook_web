<?php

namespace App\Http\Controllers\Web\StudentCreativityProgram;

use App\Http\Controllers\Controller;
use App\Models\StudentCreativityProgram;
use App\Models\StudentCreativityProgramType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('admin.study.index', compact('data'));
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

        //Upload Document
        $file_name = date('Ymd') . preg_replace('/\s+/', '_', $request->title);
        $pathName = 'storage/studentCreativityProgram/';
        $document_url = $file_name . '.' . $request->file('document_url')->extension();
        $request->file('document_url')->storeAs('studentCreativityProgram', $document_url, 'public');

        $finalPath = $pathName . $document_url;

        try {
            StudentCreativityProgram::create([
                'creativity_type' => $request->creativity_type,
                'aliases' => $request->aliases,
                'title' => $request->title,
                'abstract' => $request->abstract,
                'year' => $request->year,
                'supervisor' => $request->supervisor,
                'file_name' => $document_url,
                'document_url' => $finalPath,
            ]);

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
            $update = [
                'creativity_type' => $request->creativity_type,
                'aliases' => $request->aliases,
                'title' => $request->title,
                'abstract' => $request->abstract,
                'year' => $request->year,
                'supervisor' => $request->supervisor,
            ];

            //update data apabila menginputkan file di document_url
            if ($request->hasFile('document_url')) {
                //digunakan untuk menghapus file beradasarkan id yang diinputkan
                Storage::disk('public')->delete('studentCreativityProgram/' . $data->file_name);

                $file_name = date('Ymd') . preg_replace('/\s+/', '_', $request->title);
                $pathName = 'storage/studentCreativityProgram/';
                $document_url = $file_name . '.' . $request->file('document_url')->extension();
                $request->file('document_url')->storeAs('studentCreativityProgram', $document_url, 'public');

                $finalPath = $pathName . $document_url;

                $update = [
                    'file_name' => $document_url,
                    'document_url' => $finalPath,
                ];
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
            $data = StudentCreativityProgram::find($id);
            //digunakan untuk menghapus file beradasarkan id yang diinputkan
            Storage::disk('public')->delete('studentCreativityProgram/' . $data->file_name);
            $data = StudentCreativityProgram::destroy($id);
            return redirect()->route('admin.departements.index');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
