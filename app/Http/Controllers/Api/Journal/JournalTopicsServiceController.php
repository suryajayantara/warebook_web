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
        $data = JournalTopic::query()->with('user')->when($search , function($query) use ($search){
            $query->where('title','like','%' . $search . '%');
        })->get();

        return response()->json([
            'search_keyword' => $search,
            'data' => $data
        ],200);
    }

    /* Function ini digunakan untuk mengambil data dari database berdasarkan user yang login */
    public function getJournalTopicByAuth(){


        if(!auth('api')->check()){
            return response()->json([
                'message' => 'Anda Belum Login',
            ],401);
        }

        // Data dari Token , Disimpan di variable ini
        $user = auth()->guard('api')->user();



        $data = JournalTopic::where('users_id',$user->id)->get();
        if($data == null){
            return response()->json([
                'message' => 'Data tidak ditemukan !'.$user->id
            ],500);
        }else{
            return response()->json([
                'data' => $data
            ],200);
        }
    }

    //function ini digunakan untuk mengambil satu data dari repositori Topic dengan mengambil salah satu idnya
    public function getOneJournalTopic(Request $request, $id)
    {
        $data = JournalTopic::where('id',$id)->with('user')->first();
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

    //Fungsi ini gunanya untuk menambah data Topic pada Repositori Journal Topic
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
            $data->users_id = $user->id;
            $data->subject = $request->subject;
            $data->title = $request->title;
            $data->description = $request->description;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Data berhasil ditambahkan'
            ],200);
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    //Fungsi ini gunanya untuk mengupdate data Topic pada Repositori Journal Topic
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
            $data = JournalTopic::find($id);
            if($data == null){
                return response()->json([
                    'message' => 'Data tidak ditemukan !'
                ],500);
            }

            $data->users_id = $user->id;
            $data->subject = $request->subject;
            $data->title = $request->title;
            $data->description = $request->description;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Data berhasil diubah'
            ],200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //Fungsi ini gunanya untuk menghapus salah satu data pada repositori Journal Topic
    public function destroy($id){
        try {
            $query = JournalTopic::find($id);
            if($query == null){
                return response()->json([
                    'message' => 'Data tidak ditemukan !'
                ],500);
            }

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
