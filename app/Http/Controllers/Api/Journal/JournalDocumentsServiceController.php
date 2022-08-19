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
        $data = JournalDocument::query()->with('user.details.study.departements')->when($search , function($query) use ($search){
            $query->where('title','like','%' . $search . '%');
        })->get();

        return response()->json([
            'search_keyword' => $search,
            'data' => $data
        ],200);
    }

    /* Function ini digunakan untuk mengambil data dari database berdasarkan user yang login */
    public function getJournalDocumentByAuth(){

        $user = auth()->guard('api')->user();

        $data = JournalDocument::where('users_id',$user->id)->get();
        if($data == null){
            return response()->json([
                'message' => 'Data tidak ditemukan !'. $user->id
            ],500);
        }else{
            return response()->json([
                'data' => $data
            ],200);
        }
    }

    //function ini digunakan untuk mengambil satu data dari repositori Document dengan mengambil salah satu idnya
    public function getOneJournalDocument(Request $request, $id)
    {
        $data = JournalDocument::where('id',$id)->with('journalTopic')->first();
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

    //Fungsi ini gunanya untuk menambah data Document pada Repositori Journal Document
    public function create(Request $request){

        try {
            // Check apakah user sudah login atau belum
            if(!auth('api')->check()){
                return response()->json([
                    'message' => 'Anda Belum Login',
                ],401);
            }

            // Data dari Token , Disimpan di variable ini
            $user = auth()->guard('api')->user();

            $validate = Validator($request->all(),[
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
                    'message' => ''
                ]);
            }

            //Upload Document
            $file_name = date('Ymd').preg_replace('/\s+/','_',$request->title);
            $pathName = 'storage/journalDocument/';
            $document_url = $file_name.'.'.$request->file('document_url')->extension();
            $request->file('document_url')->storeAs('journalDocument', $document_url, 'public');

            $finalPath = $pathName . $document_url;


            $data = new JournalDocument();
            $data->users_id = $user->id;
            $data->journal_topics_id = $request->journal_topics_id;
            $data->title = $request->title;
            $data->author = $request->author;
            $data->abstract = $request->abstract;
            $data->document_url = $finalPath;
            $data->original_url = $request->original_url;
            $data->year = $request->year;
            $data->tags = $request->tags;
            $data->doi = $request->doi;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Data berhasil ditambahkan'
            ],200);
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    //Fungsi ini gunanya untuk mengupdate data Document pada Repositori Journal Document
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
            $data = JournalDocument::find($id);
            if($data == null){
                return response()->json([
                    'message' => 'Data tidak ditemukan !'
                ],500);
            }

            //update data apabila menginputkan file di document_url
            if($request->hasFile('document_url')) {
                //digunakan untuk menghapus file beradasarkan id yang diinputkan
                Storage::disk('public')->delete(str_replace('storage/', '', $data->document_url));

                $file_name = date('Ymd').preg_replace('/\s+/','_',$request->title);
                $pathName = 'storage/journalDocument/';
                $document_url = $file_name.'.'.$request->file('document_url')->extension();
                $request->file('document_url')->storeAs('journalDocument', $document_url, 'public');

                $finalPath = $pathName . $document_url;

                $data->document_url = $finalPath;
            }

            $data->users_id = $user->id;
            $data->journal_topics_id = $request->journal_topics_id;
            $data->title = $request->title;
            $data->author = $request->author;
            $data->abstract = $request->abstract;
            $data->original_url = $request->original_url;
            $data->year = $request->year;
            $data->tags = $request->tags;
            $data->doi = $request->doi;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Data berhasil diubah'
            ],200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //Fungsi ini gunanya untuk menghapus salah satu data pada repositori Journal Document
    public function destroy($id){
        try {
            $query = JournalDocument::find($id);
            if($query == null){
                return response()->json([
                    'message' => 'Data tidak ditemukan !'
                ],500);
            }

            //digunakan untuk menghapus file beradasarkan id yang diinputkan
            Storage::disk('public')->delete(str_replace('storage/', '', $query->document_url));

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
