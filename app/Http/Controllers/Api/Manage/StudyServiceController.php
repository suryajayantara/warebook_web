<?php

namespace App\Http\Controllers\Api\Manage;

use App\Http\Controllers\Controller;
use App\Models\Study;
use Illuminate\Http\Request;

class StudyServiceController extends Controller
{
    //function ini digunakan untuk mengambil dan mencari data dari study atau program studi
    public function getStudy(Request $request)
    {
        $search = request('search','');
        $data = Study::query()->when($search , function($query) use ($search){
            $query->where('studies_name','like','%' . $search . '%');
        })->get();

        return response()->json([
            'search_keyword' => $search,
            'data' => $data
        ],200);
    }
    //function ini digunakan untuk mengambil satu data dari study atau program studi dengan mengambil salah satu idnya
    public function getOneStudy(Request $request, $id)
    {
        $data = Study::where('id',$id)->with('departements')->first();
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

    /*function ini digunakan untuk mengambil semua data dari
    study atau program studi dengan mengambil salah satu
    id dari departement atau jurusan */
    public function getAllStudyByDepartement(Request $request, $id)
    {
        $data = Study::where('departement_id',$id)->get();
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

    //Fungsi ini gunanya untuk menambah data study atau program studi
    public function create(Request $request){

        try {
            $validate = Validator($request->all(),[
                'departement_id' => 'required',
                'studies_name' => 'required',
                'desc' => 'required'
            ]);

            if($validate->fails()){
                return response()->json([
                    'validate' => $validate->errors()
                ]);
            }

            $data = new Study();
            $data->departement_id = $request->departement_id;
            $data->studies_name = $request->studies_name;
            $data->desc = $request->desc;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Adding Data'
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    //Fungsi ini gunanya untuk mengupdate data study atau program studi
    public function update(Request $request,$id){
        try {
            $data = Study::find($id);
            if($data == null){
                return response()->json([
                    'message' => 'Data Not Found !'
                ],500);
            }

            $data->departement_id = $request->departement_id;
            $data->studies_name = $request->studies_name;
            $data->desc = $request->desc;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Update Data'
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    //Fungsi ini gunanya untuk menghapus salah satu data pada study atau program studi
    public function destroy($id){
        try {
            $query = Study::find($id);
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
