<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
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
        return view('register.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $account_type = $request->type;
        $studies_data = Study::all();
        return view('register.add', compact('studies_data', 'account_type'));
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
            'studies_id' => 'required',
            'email' => 'required|unique:users,email|max:100',
            'unique_id' => 'required|unique:user_details,unique_id',
            'name' => 'required|min:2|max:255',
            'password' => 'required|confirmed|min:8'
        ], [
            // 'password.same' => 'Password harus sama',
            'email.unique' => "Email anda sudah terdaftar!",
            'unique_id.unique' => "Nomor identitas anda sudah terdaftar!"
        ]);

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            if ($request->role == 'student') {
                $user->assignRole('student');
            } elseif ($request->role == 'lecture') {
                $user->assignRole('lecture');
            }
            $user->save();

            $data_parsing =  User::latest()->first();
            $study = Study::find($request->studies_id);

            UserDetail::create([
                'users_id' => $data_parsing->id,
                'departement_id' => $study->departement_id,
                'study_id' => $request->studies_id,
                'unique_id' => $request->unique_id,
            ]);

            return redirect()->route('login');
        } catch (\Throwable $th) {
            var_dump($th);
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
