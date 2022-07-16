<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Models\Study;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departement_data = Departement::all();
        $studies_data = Study::all();
        return view('register.add', compact('departement_data','studies_data'));
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
            'study_id'=>'required',
            'email'=>'required|unique:users,email',
            'unique_id'=>'required|unique:user_details,unique_id',
            'name'=>'required',
            'password'=>'required'
        ],[
            'email.unique' => "Data Sudah Ada !",
            'unique_id.unique' => "Data Sudah Ada !"
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $data_parsing = User::where('email',$request->email)->first();
            UserDetail::create([
                'users_id' => $data_parsing['id'],
                'departement_id' => $request->departement_id,
                'study_id' => $request->study_id,
                'unique_id' => $request->unique_id,
            ]);

            return redirect()->route('register.index');

        } catch (\Throwable $th) {
            throw $th;

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
