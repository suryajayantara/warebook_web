<?php

namespace App\Http\Controllers\Web\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Models\Study;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = UserDetail::paginate(6);
        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $studies_data = Study::get();
        return view('admin.user.add', compact('studies_data'));
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
            'email' => 'unique:users,email,id',
            'unique_id' => 'unique:user_details,unique_id'
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
            } else {
                $user->assignRole('admin');
            }
            $user->save();

            $new_user = User::latest()->first();
            $study = Study::find($request->studies_id);

            $detail = new UserDetail();
            $detail->users_id = $new_user->id;
            $detail->unique_id = $request->unique_id;
            $detail->departement_id = $study->departement_id;
            $detail->study_id = $study->id;
            $detail->save();

            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            // var_dump($th);
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
        $data = UserDetail::find($id);
        $studies_data = Study::all();
        return view('admin.user.edit', compact('data', 'studies_data'));
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
            $detail = UserDetail::find($id);
            $user = User::find($detail->users_id);
            $study = Study::find($request->studies_id);

            UserDetail::find($id)->update([
                'unique_id' => $request->unique_id,
                'departement_id' => $study->departement_id,
                'study_id' => $study->id,
            ]);

            User::find($detail->users_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            if (!empty($request->role)) {
                $user->syncRoles([]);
                if ($request->role == 'student') {
                    $user->$user->assignRole('student');
                } elseif ($request->role == 'lecture') {
                    $user->assignRole('lecture');
                } else {
                    $user->assignRole('admin');
                }
            }

            return redirect()->route('users.index');
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
        $user = UserDetail::find($id);
        User::destroy($user->users_id);

        return redirect()->route('users.index');
    }
}
