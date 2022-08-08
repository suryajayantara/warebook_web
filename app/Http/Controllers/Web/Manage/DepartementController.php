<?php

namespace App\Http\Controllers\Web\Manage;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Departement::paginate(6);
        return view('admin.departement.index', compact('data'));
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
            'departement_name' => 'required|unique:departements,departement_name,id',
            'desc' => 'required'
        ], [
            'departement_name.unique' => "Data Sudah Ada !"
        ]);

        try {
            Departement::create([
                'departement_name' => $request->departement_name,
                'desc' => $request->desc
            ]);
            return redirect()->route('departements.index');

        } catch (\Throwable $th) {
            // throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data = Departement::where('departement_name', 'LIKE', '%'.$request->search.'%')->orWhere('desc', 'LIKE', '%'.$request->search.'%')->paginate(6);
        return view('admin.departement.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departement_data = Departement::find($id);
        return view('admin.departement.edit')->with(compact('departement_data'));
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
            'departement_name' => 'required',
            'desc' => 'required'
        ]);

        try {
            Departement::find($id)->update([
                'departement_name' => $request->departement_name,
                'desc' => $request->desc
            ]);
            return redirect()->route('departements.index');

        } catch (\Throwable $th) {
            // throw $th;
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
            Departement::destroy($id);
            return redirect('departements');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
