<?php

namespace App\Http\Controllers\Api\StudentCreativityProgram;

use App\Http\Controllers\Controller;
use App\Models\StudentCreativityProgramType;
use Illuminate\Http\Request;

class StudentCreativityProgramTypeServiceController extends Controller
{
    //function ini digunakan untuk mengambil dan mencari data dari repositori PKM
    public function getCreativityType(Request $request)
    {
        $search = request('search','');
        $data = StudentCreativityProgramType::query()->when($search , function($query) use ($search){
            $query->where('type_name','like','%' . $search . '%');
        })->get();

        return response()->json([
            'search_keyword' => $search,
            'data' => $data
        ],200);
    }
    //function ini digunakan untuk mengambil satu data type dari repositori PKM dengan mengambil salah satu idnya
    public function getOneCreativityType(Request $request, $id)
    {
        $data = StudentCreativityProgramType::find($id);
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

    //Fungsi ini gunanya untuk menambah data type pada Repositori PKM
    public function create(Request $request){

        try {
            $validate = Validator($request->all(),[
                'type_name' => 'required',
                'aliases' => 'required',
                'desc' => 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'validate' => $validate->errors()
                ]);
            }

            $data = new StudentCreativityProgramType();
            $data->type_name = $request->type_name;
            $data->aliases = $request->aliases;
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

    //Fungsi ini gunanya untuk mengupdate data type pada Repositori PKM
    public function update(Request $request,$id){
        try {
            $data = StudentCreativityProgramType::find($id);
            if($data == null){
                return response()->json([
                    'message' => 'Data Not Found !'
                ],500);
            }

            $data->type_name = $request->type_name;
            $data->aliases = $request->aliases;
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

    //Fungsi ini gunanya untuk menghapus salah satu data type pada repositori PKM
    public function destroy($id){
        try {
            $query = StudentCreativityProgramType::find($id);
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

    // Start new Function HERE
}
