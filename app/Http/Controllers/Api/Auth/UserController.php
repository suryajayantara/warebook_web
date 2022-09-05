<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Models\Study;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;

class UserController extends Controller
{

    public function getUser(){
        if(!auth('api')->check()){
            return response()->json([
                'message' => 'Anda Belum Login',
            ],401);
        }
        // Data dari Token , Disimpan di variable ini
        $data = auth()->guard('api')->user();

        return response()->json([
            'role' => auth()->guard('api')->user()->roles->pluck('name'),
            'name' => $data->name,
            'email' => $data->email,
            'departement' => $data->details->departements->departemen_name,
            'study' => $data->details->study,
            'departement' => $data->details->departements
        ],200);
    }


    /*

    */

    public function login(){
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            $user = Auth::user();
            $success = $user->createToken('appToken')->accessToken;
           //After successfull authentication, notice how I return json parameters
            return response()->json([
              'user' => $user,
              'role' => $user->roles->pluck('name')[0],
              'success' => true,
              'token' => $success,
              
              
          ]);
        } else {
       //if authentication is unsuccessfull, notice how I return json parameters
          return response()->json([
            'success' => false,
            'message' => 'Invalid Email or Password',
        ], 401);
        }
    }

    public function newTokenGenerate(){

    }

    public function register(Request $request){

      // if($request->roles != 'student' || $request->roles != 'lecturer'){
      //   return response()->json([
      //     'message' => 'You Not select any roles'
      //   ]);
      // }

        if ($request->roles != 'student' && $request->roles != 'lecture') {
            return response()->json([
                'message' => 'Roles Tidak Ada',
            ],401);
        }

        $user = new User();
        $detail = new UserDetail();
        $departement = Study::where('id',$request->study_id)->first();

        // User Register => To Users Models
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $user->assignRole($request->roles);


        $detail->users_id = $user->id;
        $detail->unique_id = $request->unique_id;
        $detail->departement_id = $departement->departement_id;
        $detail->study_id = $request->study_id;
        $detail->save();


        // User Details => to UsersDetails Models

        $token = $user->createToken('appToken')->accessToken;
        return response()->json([
          'success' => true,
          'token' => $token,
          'user' => $user,
          'detail' => $detail
      ]);
    }

    public function logout(Request $res)
    {
      if (Auth::user()) {
        $user = Auth::user()->token();
        $user->revoke();
        return response()->json([
          'success' => true,
          'message' => 'Logout successfully'
      ]);
      }else {
        return response()->json([
          'success' => false,
          'message' => 'Unable to Logout'
        ]);
      }
     }
}
