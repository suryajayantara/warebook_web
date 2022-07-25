<?php

namespace App\Http\Controllers\Api\Journal;

use App\Http\Controllers\Controller;
use App\Models\JournalType;
use Illuminate\Http\Request;

class JournelTypesServiceController extends Controller
{
    //function ini digunakan untuk mengambil dan mencari data dari Journal Type
    public function getJournalType(Request $request)
    {
        $search = request('search','');
        $data = JournalType::query()->when($search , function($query) use ($search){
            $query->where('journal_types','like','%' . $search . '%');
        })->get();

        return response()->json([
            'search_keyword' => $search,
            'data' => $data
        ],200);
    }
    //function ini digunakan untuk mengambil satu data type dari Journal Type dengan mengambil salah satu idnya
    public function getOneJournalType(Request $request, $id)
    {
        $data = JournalType::find($id);
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

    //Fungsi ini gunanya untuk menambah data type pada Journal Type
    public function create(Request $request){

        try {
            $validate = Validator($request->all(),[
                'journal_types' => 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'validate' => $validate->errors()
                ]);
            }

            $data = new JournalType();
            $data->journal_types = $request->journal_types;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Adding Data'
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    //Fungsi ini gunanya untuk mengupdate data type pada Journal Type
    public function update(Request $request,$id){
        try {
            $data = JournalType::find($id);
            if($data == null){
                return response()->json([
                    'message' => 'Data Not Found !'
                ],500);
            }

            $data->journal_types = $request->journal_types;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Update Data'
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    //Fungsi ini gunanya untuk menghapus salah satu data type pada Journal Type
    public function destroy($id){
        try {
            $query = JournalType::find($id);
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

    // Start new Function HER
}
