<?php

namespace App\Http\Controllers\Web\StudentCreativityProgram;

use App\Http\Controllers\Controller;
use App\Models\StudentCreativityProgramType;
use Illuminate\Http\Request;

class StudentCreativityProgramTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = StudentCreativityProgramType::all();
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
            'type_name' => 'required',
            'aliases' => 'required',
            'desc' => 'required',
        ]);

        try {
            StudentCreativityProgramType::create([
                'type_name' => $request->type_name,
                'aliases' => $request->aliases,
                'desc' => $request->desc
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
        $creativityType = StudentCreativityProgramType::find($id);
        return view('admin.departement.edit')->with(compact('creativityType'));
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
            StudentCreativityProgramType::find($id)->update([
                'type_name' => $request->type_name,
                'aliases' => $request->aliases,
                'desc' => $request->desc
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
            StudentCreativityProgramType::find($id)->delete();
            return redirect()->route('admin.departements.index');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
