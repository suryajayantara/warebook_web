<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use Illuminate\Http\Request;

class ThesisServiceController extends Controller
{
    /* Function ini digunakan untuk mengambil data dari database */
    public function getThesis(Request $request){
        $search = request('search','');
        $data = Thesis::query()->when($search , function($query) use ($search){
            $query->where('title','like','%' . $search . '%');
        })->get();

        return response()->json([
            'search_keyword' => $search,
            'data' => $data
        ],200);

    }

    // Fungsi ini gunanya untuk mengambil detail dari 1 data Repositori Tugas Akhir
    // Kalo ini work , biarin , gausah dikutak kutik lagi
    public function getOneThesis($id){
        $data = Thesis::where('id',$id)->with('documents')->first();
        return response()->json([
            'data' => $data
        ],200);
    }

    //Fungsi ini gunanya untuk menambah data thesis pada Repositori Tugas Akhir
    public function create(Request $request){ 
        // Check apakah user sudah login atau belum
        if(!auth('api')->check()){
            return response()->json([
                'message' => 'Anda Belum Login',
            ],401);
        }

        // Data dari Token , Disimpan di variable ini
        $user = auth()->guard('api')->user();  

        // Olahan file disini
        $file = $request->file('thumbnail_img');
        $filename = date('yymmdd')."$user->id-"."." . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/thesis/background',$filename);        

        try {
            
            // $validate = Validator($request->all(),[
            //     'users_id' => 'required',
            //     'thesis_type' => 'required',
            //     'thumbnail_url' => 'required',
            //     'title' => 'required',
            //     'abstract' => 'required',
            //     'tags' => 'required',
            // ]);

            // if($validate->fails()){
            //     return response()->json([
            //         'validate' => $validate->errors()
            //     ]);
            // }

            $thumbnail = $request->file('thumbnail_url');
            $thumbnail_name = strtolower($request->title)."-img-thumbnail.".$thumbnail->getClientOriginalExtension();

            $data = new Thesis();
            $data->users_id = $user->id;
            $data->thesis_type = 'Tugas Akhir';
            $data->title = $request->title;
            $data->created_year = 2021;
            $data->abstract = $request->abstract;
            $data->thumbnail_url = "storage/thesis/background/" . $filename;
            $data->tags = $request->tags;

            $thumbnail->move('img/thesis/thumbnail/',$thumbnail_name);
            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Adding Data'
            ],200);
        } catch (\Throwable $th) {
            throw $th;
        }}
    

    //Fungsi ini gunanya untuk mengupdate data thesis pada Repositori Tugas Akhir
    public function update(Request $request,$id){
        try {
            $data = Thesis::find($id);
            if($data == null){
                return response()->json([
                    'message' => 'Data Not Found !'
                ],500);
            }

            if($request->file('thumbnail_url') !== NULL){
                unlink('img/thesis/thumbnail/'.$data['thumbnail_url']);
                $thumbnail = $request->file('thumbnail_url');
                $thumbnail_name = strtolower($request->title)."-img-thumbnail.".$thumbnail->getClientOriginalExtension();

                $data->thumbnail_url = $thumbnail_name;

                //move digunakan untuk memindahkan file ke folder public lalu dilanjutkan ke folder img/internalResearch/thumbnail
                $thumbnail->move('img/thesis/thumbnail/',$thumbnail_name);
            }

            $data->users_id = $request->users_id;
            $data->thesis_type = $request->thesis_type;
            $data->title = $request->title;
            $data->abstract = $request->abstract;
            $data->created_year = $request->created_year;
            $data->tags = $request->tags;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Update Data'
            ],200);
        } catch (\Throwable $th) {
            // throw $th;
        }
    }

    //Fungsi ini untuk menghapus salah satu data thesis pada Repositori Tugas Akhir
    public function destroy($id){
        try {
            $query = Thesis::find($id);
            unlink('img/thesis/thumbnail/'.$query['thumbnail_url']);
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
