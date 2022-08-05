<?php

namespace App\Http\Controllers\Api\Journal;

use App\Http\Controllers\Controller;
use App\Models\JournalTopic;
use Illuminate\Http\Request;

class JournalTopicsServiceController extends Controller
{
    //function ini digunakan untuk mengambil dan mencari data dari repositori Journal Topic
    public function getJournalTopic(Request $request)
    {
        $search = request('search','');
        $data = JournalTopic::query()->when($search , function($query) use ($search){
            $query->where('title','like','%' . $search . '%');
        })->get();

        return response()->json([
            'search_keyword' => $search,
            'data' => $data
        ],200);
    }
    //function ini digunakan untuk mengambil satu data dari repositori Topic dengan mengambil salah satu idnya
    public function getOneJournalTopic(Request $request, $id)
    {
        $data = JournalTopic::where('id',$id)->with('user')->first();
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

    //Fungsi ini gunanya untuk menambah data Topic pada Repositori Journal Topic
    public function create(Request $request){

        try {
            $validate = Validator($request->all(),[
                'users_id' => 'required',
                'subject' => 'required',
                'title' => 'required',
                'description' => 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'validate' => $validate->errors()
                ]);
            }

            $data = new JournalTopic();
            $data->users_id = $request->users_id;
            $data->subject = $request->subject;
            $data->title = $request->title;
            $data->description = $request->description;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Adding Data'
            ],200);
        } catch (\Throwable $th) {
            // throw $th;
        }

    }

    //Fungsi ini gunanya untuk mengupdate data Topic pada Repositori Journal Topic
    public function update(Request $request,$id){
        try {
            $data = JournalTopic::find($id);
            if($data == null){
                return response()->json([
                    'message' => 'Data Not Found !'
                ],500);
            }

            $data->users_id = $request->users_id;
            $data->subject = $request->subject;
            $data->title = $request->title;
            $data->description = $request->description;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Update Data'
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    //Fungsi ini gunanya untuk menghapus salah satu data pada repositori Journal Topic
    public function destroy($id){
        try {
            $query = JournalTopic::find($id);
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
            // throw $th;
        }

    }

    // Start new Function HERE
}
