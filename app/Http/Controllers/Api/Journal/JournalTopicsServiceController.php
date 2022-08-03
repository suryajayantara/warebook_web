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
        $data = JournalTopic::find($id)->with('journalType')->first();
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

            $thumbnail = $request->file('thumbnail_url');
            $thumbnail_name = strtolower($request->title)."-img-thumbnail.".$thumbnail->getClientOriginalExtension();

            $data = new JournalTopic();
            $data->users_id = $request->users_id;
            $data->journal_types_id = $request->journal_types_id;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->thumbnail_url = $thumbnail_name;

            $thumbnail->move('img/journal/thumbnail/',$thumbnail_name);

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Adding Data'
            ],200);
        } catch (\Throwable $th) {
            throw $th;
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

            if($request->file('thumbnail_url') !== NULL){
                unlink('img/journal/thumbnail/'.$data['thumbnail_url']);
                $thumbnail = $request->file('thumbnail_url');
                $thumbnail_name = strtolower($request->title)."-img-thumbnail.".$thumbnail->getClientOriginalExtension();

                $data->thumbnail_url = $thumbnail_name;

                //move digunakan untuk memindahkan file ke folder public lalu dilanjutkan ke folder img/internalResearch/thumbnail
                $thumbnail->move('img/journal/thumbnail/',$thumbnail_name);
            }

            $data->users_id = $request->users_id;
            $data->journal_types_id = $request->journal_types_id;
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
            unlink('img/journal/thumbnail/'.$query['thumbnail_url']);
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
