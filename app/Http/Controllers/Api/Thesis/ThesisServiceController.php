<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use Illuminate\Http\Request;

class ThesisServiceController extends Controller
{
    /* Function ini digunakan untuk mengambil data dari database */
    public function getThesis(Request $request){
        $search = request('search','');
        $data = Thesis::query()->with('users.details.study.departements')->when($search , function($query) use ($search){
            $query->where('title','like','%' . $search . '%');
        })->get();

        return response()->json([
            'search_keyword' => $search,
            'data' => $data
        ],200);

    }

    /* Function ini digunakan untuk mengambil data dari database berdasarkan user yang login */
    public function getThesisByAuth(){
        $data = Thesis::where('users_id',strval(auth()->guard('api')->user()->id))->get();
        if($data == null){
            return response()->json([
                'message' => 'Data tidak ditemukan !'
            ],500);
        }else{
            return response()->json([
                'data' => $data
            ],200);
        }
    }

    // Fungsi ini gunanya untuk mengambil detail dari 1 data Repositori Tugas Akhir
    // Kalo ini work , biarin , gausah dikutak kutik lagi
    public function getOneThesis($id){
        $data = Thesis::where('id',$id)->with('user')->first();
        if($data == null){
            return response()->json([
                'message' => 'Data tidak ditemukan !'
            ],500);
        }else{
            return response()->json([
                'data' => $data
            ],200);
        }
    }

    //Fungsi ini gunanya untuk menambah data thesis pada Repositori Tugas Akhir
    public function create(Request $request){
        // Check apakah user sudah login atau belum
        if(!auth('api')->check()){
            return response()->json([
                'message' => 'Anda Belum Login',
            ],401);
        }

        // Data dari Token , Disimpan di variable ini
        $user = auth()->guard('api')->user();

        try {

            // $validate = Validator($request->all(),[
            //     'thesis_type' => 'required',
            //     'thumbnail_url' => 'required',
            //     'title' => 'required',
            //     'abstract' => 'required',
            //     'tags' => 'required',
            // ]);

            // if($validate->fails()){
            //     return response()->json([
            //         'validate' => $validate->errors()
            //     ]);
            // }

            $data = new Thesis();
            $data->users_id = $user->id;
            $data->thesis_type = 'Tugas Akhir';
            $data->title = $request->title;
            $data->created_year = 2021;
            $data->abstract = $request->abstract;
            $data->tags = $request->tags;
            $data->author = $user->name;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Adding Data'
            ],200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    //Fungsi ini gunanya untuk mengupdate data thesis pada Repositori Tugas Akhir
    public function update(Request $request,$id){
        try {
            // Check apakah user sudah login atau belum
            if(!auth('api')->check()){
                return response()->json([
                    'message' => 'Anda Belum Login',
                ],401);
            }

            // Data dari Token , Disimpan di variable ini
            $user = auth()->guard('api')->user();

            // Check apakah data dari id diinputkan ada atau tidak datanya
            $data = Thesis::find($id);
            if($data == null){
                return response()->json([
                    'message' => 'Data tidak ditemukan !'
                ],500);
            }


            $data->users_id = $user->id;
            $data->thesis_type = $request->thesis_type;
            $data->title = $request->title;
            $data->abstract = $request->abstract;
            $data->created_year = $request->created_year;
            $data->tags = $request->tags;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Data berhasil diubah'
            ],200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //Fungsi ini untuk menghapus salah satu data thesis pada Repositori Tugas Akhir
    public function destroy($id){
        try {
            $query = Thesis::find($id);
            if($query == null){
                return response()->json([
                    'message' => 'Data tidak ditemukan !'
                ],500);
            }
            $query->delete();
            if($query){
                return response()->json([
                    'message' => 'Data berhasil dihapus !'
                ],200);
            }else{
                return response()->json([
                    'message' => 'Data tidak terhapus'
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    // Start new Function HERE
}
