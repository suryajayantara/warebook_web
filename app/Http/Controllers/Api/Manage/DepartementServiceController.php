<?php

namespace App\Http\Controllers\Api\Manage;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementServiceController extends Controller
{
    //function ini digunakan untuk mengambil dan mencari data dari Departement atau Jurusan
    public function getDepartement(Request $request)
    {
        $search = request('search','');
        $data = Departement::query()->when($search , function($query) use ($search){
            $query->where('departement_name','like','%' . $search . '%');
        })->get();

        return response()->json([
            'search_keyword' => $search,
            'data' => $data
        ],200);
    }
    //function ini digunakan untuk mengambil satu data dari Departement atau Jurusan dengan mengambil salah satu idnya
    public function getOneDepartement(Request $request, $id)
    {
        $data = Departement::find($id);
        if($data == null){
            return response()->json([
                'message' => 'Data Not Found !'
            ],500);
        }else{
            return response()->json([
                'data' => $data
            ],200);
        }
    }

    //Fungsi ini gunanya untuk menambah data Departement atau Jurusan
    public function create(Request $request){

        try {
            $validate = Validator($request->all(),[
                'departement_name' => 'required',
                'desc' => 'required'
            ]);

            if($validate->fails()){
                return response()->json([
                    'validate' => $validate->errors()
                ]);
            }

            $data = new Departement();
            $data->departement_name = $request->departement_name;
            $data->desc = $request->desc;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Adding Data'
            ],200);
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    //Fungsi ini gunanya untuk mengupdate data Departement atau Jurusan
    public function update(Request $request,$id){
        try {
            $data = Departement::find($id);
            if($data == null){
                return response()->json([
                    'message' => 'Data Not Found !'
                ],500);
            }

            $data->departement_name = $request->departement_name;
            $data->desc = $request->desc;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Update Data'
            ],200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //Fungsi ini gunanya untuk menghapus salah satu data pada Departement atau Jurusan
    public function destroy($id){
        try {
            $query = Departement::find($id);
            if($query == null){
                return response()->json([
                    'message' => 'Data Not Found !'
                ],500);
            }

            $query->delete();
            if($query){
                return response()->json([
                    'message' => 'Successful Deleting Data !'
                ],200);
            }else{
                return response()->json([
                    'message' => 'Data Not Deleted'
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }

    }
}
