<?php

namespace App\Http\Controllers\Api\Journal;

use App\Http\Controllers\Controller;
use App\Models\JournalDocument;
use Illuminate\Http\Request;

class JournalDocumentsServiceController extends Controller
{
    //function ini digunakan untuk mengambil dan mencari data dari repositori Journal Document
    public function getJournalDocument(Request $request)
    {
        $search = request('search','');
        $data = JournalDocument::query()->when($search , function($query) use ($search){
            $query->where('title','like','%' . $search . '%');
        })->get();

        return response()->json([
            'search_keyword' => $search,
            'data' => $data
        ],200);
    }
    //function ini digunakan untuk mengambil satu data dari repositori Document dengan mengambil salah satu idnya
    public function getOneJournalDocument(Request $request, $id)
    {
        $data = JournalDocument::find($id)->with('journalTopic')->first();
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

    //Fungsi ini gunanya untuk menambah data Document pada Repositori Journal Document
    public function create(Request $request){

        try {
            $validate = Validator($request->all(),[
                'journal_topics_id' => 'required',
                'title' => 'required',
                'author' => 'required',
                'abstract' => 'required',
                'year' => 'required'
            ]);

            if($validate->fails()){
                return response()->json([
                    'validate' => $validate->errors()
                ]);
            }

            $data = new JournalDocument();
            $data->journal_topics_id = $request->journal_topics_id;
            $data->title = $request->title;
            $data->author = $request->author;
            $data->abstract = $request->abstract;
            $data->year = $request->year;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Adding Data'
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    //Fungsi ini gunanya untuk mengupdate data Document pada Repositori Journal Document
    public function update(Request $request,$id){
        try {
            $data = JournalDocument::find($id);
            if($data == null){
                return response()->json([
                    'message' => 'Data Not Found !'
                ],500);
            }

            $data->journal_topics_id = $request->journal_topics_id;
            $data->title = $request->title;
            $data->author = $request->author;
            $data->abstract = $request->abstract;
            $data->year = $request->year;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Update Data'
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    //Fungsi ini gunanya untuk menghapus salah satu data pada repositori Journal Document
    public function destroy($id){
        try {
            $query = JournalDocument::find($id);
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
