<?php

namespace App\Http\Controllers\Api\Journal;

use App\Http\Controllers\Controller;
use App\Models\JournalTopic;
use Illuminate\Http\Request;

class JournelTopicsServiceController extends Controller
{
    /* Function ini digunakan untuk mengambil data dari database */
    public function getJournalTopic(Request $request){
        $search = request('search','');
        $data = JournalTopic::query()->when($search , function($query) use ($search){
            $query->where('title','like','%' . $search . '%');
        })->get();

        return response()->json([
            'search_keyword' => $search,
            'data' => $data
        ],200);

    }

    // Fungsi ini gunanya untuk mengambil detail dari 1 data Journal Topic
    // Kalo ini work , biarin , gausah dikutak kutik lagi
    public function getOneJournalTopic($id){
        $data = JournalTopic::find($id)->with('journalType')->first();
        return response()->json([
            'data' => $data
        ],200);
    }

    //Fungsi ini gunanya untuk menambah data Journal Topic
    public function create(Request $request){

        try {
            $validate = Validator($request->all(),[
                'users_id' => 'required',
                'journal_types_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'thumbnail_url' => 'required'
            ]);

            if($validate->fails()){
                return response()->json([
                    'validate' => $validate->errors()
                ]);
            }

            $data = new JournalTopic();
            $data->users_id = $request->users_id;
            $data->journal_types_id = $request->journal_types_id;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->thumbnail_url = $request->thumbnail_url;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Adding Data'
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    //Fungsi ini gunanya untuk mengupdate data Journal Topic
    public function update(Request $request,$id){
        try {

            $data = JournalTopic::find($id);
            $data->users_id = $request->users_id;
            $data->journal_types_id = $request->journal_types_id;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->thumbnail_url = $request->thumbnail_url;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Update Data'
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

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
            throw $th;
        }

    }

    // Start new Function HERE

}
