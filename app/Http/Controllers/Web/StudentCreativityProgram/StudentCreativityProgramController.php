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
        $creativityType = StudentCreativityProgramType::all();
        return view('admin.departement.add')->with(compact('creativityType'));
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
            'title' => 'required',
            'abstract' => 'required',
            'year' => 'required',
            'thumbnail_url' => 'required',
            'supervisor' => 'required',
            'document_url' => 'required'
        ]);

        try {
            StudentCreativityProgram::create([
                'creativity_type' => $request->creativity_type,
                'title' => $request->title,
                'abstract' => $request->abstract,
                'year' => $request->year,
                'thumbnail_url' => $request->thumbnail_url,
                'supervisor' => $request->supervisor,
                'document_url' => $request->document_url
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
        $creativityType = StudentCreativityProgramType::all();
        return view('admin.departement.edit')->with(compact('creativity','creativityType'));
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
            StudentCreativityProgram::find($id)->update([
                'creativity_type' => $request->creativity_type,
                'title' => $request->title,
                'abstract' => $request->abstract,
                'year' => $request->year,
                'thumbnail_url' => $request->thumbnail_url,
                'supervisor' => $request->supervisor,
                'document_url' => $request->document_url
            ]);
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
            StudentCreativityProgram::find($id)->delete();
            return redirect()->route('admin.departements.index');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
