<?php

namespace App\Http\Controllers\Api\InternalResearch;

use App\Http\Controllers\Controller;
use App\Models\InternalResearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InternalResearchServiceController extends Controller
{
    //function ini digunakan untuk mengambil dan mencari data dari repositori InternalResearch
    public function getResearch(Request $request)
    {
        $search = request('search','');
        $data = InternalResearch::query()->with('users')->when($search , function($query) use ($search){
            $query->where('title','like','%' . $search . '%');
        })->get();

        return response()->json([
            'search_keyword' => $search,
            'data' => $data
        ],200);
    }

    /* Function ini digunakan untuk mengambil data dari database berdasarkan user yang login */
    public function getResearchByAuth(){
        $data = InternalResearch::where('users_id', strval(auth()->guard('api')->user()->id))->get();
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

    //function ini digunakan untuk mengambil satu data dari repositori InternalResearch dengan mengambil salah satu idnya
    public function getOneResearch(Request $request, $id)
    {
        $data = InternalResearch::where('id',$id)->with('users')->first();

        //digunakan saat
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

    //Fungsi ini gunanya untuk menambah data InternalResearch pada Repositori InternalResearch
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
                'title' => 'required',
                'abstract' => 'required',
                'budget_type' => 'required',
                'budget' => 'required',
                'project_started_at' => 'required',
                'project_finish_at' => 'required',
                'contract_number' => 'required',
                'team_member' => 'required',
                'proposal_url' => 'required',
                'document_url' => 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'message' => 'Salah satu data tidak boleh kosong'
                ]);
            }

            //Upload Document
            $file_name = date('Ymd').preg_replace('/\s+/','_',$request->title);
            $pathNameDoc = 'storage/internalResearch/document/';
            $pathNameProp = 'storage/internalResearch/proposal/';
            $document_url = $file_name.'.'.$request->file('document_url')->extension();
            $proposal_url = $file_name.'.'.$request->file('proposal_url')->extension();
            $request->file('document_url')->storeAs('internalResearch/document', $document_url, 'public');
            $request->file('proposal_url')->storeAs('internalResearch/proposal', $proposal_url, 'public');

            $finalPathDoc = $pathNameDoc . $document_url;
            $finalPathProp = $pathNameProp . $proposal_url;

            $data = new InternalResearch();
            $data->users_id = $user->id;
            $data->title = $request->title;
            $data->abstract = $request->abstract;
            $data->budget_type = $request->budget_type;
            $data->budget = $request->budget;
            $data->project_started_at = $request->project_started_at;
            $data->project_finish_at = $request->project_finish_at;
            $data->contract_number = $request->contract_number;
            $data->team_member = $request->team_member;
            $data->proposal_url = $finalPathDoc;
            $data->document_url = $finalPathProp;

            $data->save();

            if($data == null){
                return response()->json([
                    'message' => 'Data tidak ditemukan !'
                ],401);
            }

            return response()->json([
                'data' => $data,
                'message' => 'Data berhasil ditambahkan'
            ],200);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //Fungsi ini gunanya untuk mengupdate data InternalResearch pada Repositori InternalResearch
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
            $data = InternalResearch::find($id);
            if($data == null){
                return response()->json([
                    'message' => 'Data tidak ditemukan !'
                ],500);
            }

            //update data apabila menginputkan file di document_url
            if($request->hasFile('document_url')) {
                //digunakan untuk menghapus file beradasarkan id yang diinputkan
                Storage::disk('public')->delete(str_replace('storage/', '', $data->document_url));

                //Upload Document
                $file_name = date('Ymd').preg_replace('/\s+/','_',$request->title);
                $pathNameDoc = 'storage/internalResearch/document/';
                $document_url = $file_name.'.'.$request->file('document_url')->extension();
                $request->file('document_url')->storeAs('internalResearch/document', $document_url, 'public');

                $finalPathDoc = $pathNameDoc . $document_url;

                $data->document_url = $finalPathDoc;
            }

            //update data apabila menginputkan file di document_url
            if($request->hasFile('document_url')) {
                //digunakan untuk menghapus file beradasarkan id yang diinputkan
                Storage::disk('public')->delete(str_replace('storage/', '', $data->proposal_url));

                //Upload Document
                $file_name = date('Ymd').preg_replace('/\s+/','_',$request->title);
                $pathNameProp = 'storage/internalResearch/proposal/';
                $proposal_url = $file_name.'.'.$request->file('proposal_url')->extension();
                $request->file('proposal_url')->storeAs('internalResearch/proposal', $proposal_url, 'public');

                $finalPathProp = $pathNameProp . $proposal_url;

                $data->proposal_url = $finalPathProp;
            }


            $data->users_id = $user->id;
            $data->title = $request->title;
            $data->abstract = $request->abstract;
            $data->budget_type = $request->budget_type;
            $data->budget = $request->budget;
            $data->project_started_at = $request->project_started_at;
            $data->project_finish_at = $request->project_finish_at;
            $data->contract_number = $request->contract_number;
            $data->team_member = $request->team_member;

            $data->save();

            if($data == null){
                return response()->json([
                    'message' => 'Data tidak ditemukan'
                ],401);
            }

            return response()->json([
                'data' => $data,
                'message' => 'Data berhasil diubah'
            ],200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //Fungsi ini gunanya untuk menghapus salah satu data pada repositori InternalResearch
    public function destroy($id){
        try {
            $query = InternalResearch::find($id);

            if($query == null){
                return response()->json([
                    'message' => 'Data tidak ditemukan !'
                ],500);
            }

            //digunakan untuk menghapus file beradasarkan id yang diinputkan
            Storage::disk('public')->delete(str_replace('storage/', '', $query->document_url));
            Storage::disk('public')->delete(str_replace('storage/', '', $query->proposal_url));

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
