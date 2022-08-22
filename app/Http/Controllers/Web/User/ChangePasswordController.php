<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function index()
    {
        # code...
    }
    public function edit($id)
    {
        return view('user.edit.password.edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|different:old_password',
            'old_password' => 'required|'
        ]);

        $user = User::find(Auth::user()->id);
        if (password_verify($user->password, $request->old_password)) {
            try {
                User::where('id', Auth::user()->id)->update([
                    'password' => bcrypt($request->password),
                ]);

                return redirect()->route('user.show', Auth::user()->id);
            } catch (\Throwable $th) {
                throw $th;
            }
        } else {
            // return 
        }
    }
}
