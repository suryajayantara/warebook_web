<?php

namespace App\Http\Controllers\Api\Journal;

use App\Http\Controllers\Controller;
use App\Models\JournalDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JournalDocumentsServiceController extends Controller
{
    //function ini digunakan untuk mengambil dan mencari data dari repositori Journal Document
    public function getJournalDocument(Request $request)
    {
        $search = request('search','');
        $data = JournalDocument::query()->with('user')->when($search , function($query) use ($search){
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
        $data = JournalDocument::where('id',$id)->with('journalTopic')->first();
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
                'users_id' => 'required',
                'journal_topics_id' => 'required',
                'title' => 'required',
                'author' => 'required',
                'abstract' => 'required',
                'year' => 'required',
                'tags' => 'required',
                'doi' => 'required',
                'original_url' => 'required',
                'document_url' => 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'validate' => $validate->errors()
                ]);
            }

            //Upload Document
            $file_name = date('Ymd').preg_replace('/\s+/','_',$request->title);
            $pathName = 'storage/journalDocument/';
            $document_url = $file_name.'.'.$request->file('document_url')->extension();
            $request->file('document_url')->storeAs('journalDocument', $document_url, 'public');

            $finalPath = $pathName . $document_url;


            $data = new JournalDocument();
            $data->users_id = $request->users_id;
            $data->journal_topics_id = $request->journal_topics_id;
            $data->title = $request->title;
            $data->author = $request->author;
            $data->abstract = $request->abstract;
            $data->file_name = $document_url;
            $data->document_url = $finalPath;
            $data->original_url = $request->original_url;
            $data->year = $request->year;
            $data->tags = $request->tags;
            $data->doi = $request->doi;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Adding Data'
            ],200);
        } catch (\Throwable $th) {
            // throw $th;
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

            //update data apabila menginputkan file di document_url
            if($request->hasFile('document_url')) {
                //digunakan untuk menghapus file beradasarkan id yang diinputkan
                Storage::disk('public')->delete('journalDocument/'.$data->file_name);

                $file_name = date('Ymd').preg_replace('/\s+/','_',$request->title);
                $pathName = 'storage/journalDocument/';
                $document_url = $file_name.'.'.$request->file('document_url')->extension();
                $request->file('document_url')->storeAs('journalDocument', $document_url, 'public');

                $finalPath = $pathName . $document_url;

                $data->document_url = $finalPath;
            }

            $data->users_id = $request->users_id;
            $data->journal_topics_id = $request->journal_topics_id;
            $data->title = $request->title;
            $data->author = $request->author;
            $data->abstract = $request->abstract;
            $data->file_name = $document_url;
            $data->original_url = $request->original_url;
            $data->year = $request->year;
            $data->tags = $request->tags;
            $data->doi = $request->doi;

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

            //digunakan untuk menghapus file beradasarkan id yang diinputkan
            Storage::disk('public')->delete('journalDocument/'.$query->file_name);

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
