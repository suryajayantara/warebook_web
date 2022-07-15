<?php

namespace App\Http\Controllers\Web\Manage;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Models\Study;
use Illuminate\Http\Request;

class StudyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Study::all();
        return view('admin.study.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departement_data = Departement::all();
        return view('admin.study.add', compact('departement_data'));
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
            'departement_id'=>'required',
            'studies_name' => 'required|unique:studies,studies_name,id',
            'desc' => 'required'
        ], [
            'studies_name.unique' => "Data Sudah Ada !"
        ]);

        try {
            Study::create([
                'departement_id' => $request->departement_id,
                'studies_name' => $request->studies_name,
                'desc' => $request->desc
            ]);
            return redirect()->route('studies.index');

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
        $departement_data = Departement::all();
        $study_data = Study::find($id);
        return view('admin.study.edit')->with(compact('departement_data', 'study_data'));
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
            'departement_id'=>'required',
            'studies_name' => 'required',
            'desc' => 'required'
        ], [
            'studies_name.unique' => "Data Sudah Ada !"
        ]);

        try {
            Study::find($id)->update([
                'departement_id' => $request->departement_id,
                'studies_name' => $request->studies_name,
                'desc' => $request->desc
            ]);
            return redirect()->route('studies.index');

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
            Study::find($id)->delete();
            return redirect()->route('studies');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
