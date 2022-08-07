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
    //function ini digunakan untuk mengambil satu data dari repositori InternalResearch dengan mengambil salah satu idnya
    public function getOneResearch(Request $request, $id)
    {
        $data = InternalResearch::where('id',$id)->with('users')->first();

        //digunakan saat
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

    //Fungsi ini gunanya untuk menambah data InternalResearch pada Repositori InternalResearch
    public function create(Request $request){

        try {
            $validate = Validator($request->all(),[
                'users_id' => 'required',
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
                    'validate' => $validate->errors()
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
            $data->users_id = $request->users_id;
            $data->title = $request->title;
            $data->abstract = $request->abstract;
            $data->budget_type = $request->budget_type;
            $data->budget = $request->budget;
            $data->project_started_at = $request->project_started_at;
            $data->project_finish_at = $request->project_finish_at;
            $data->contract_number = $request->contract_number;
            $data->team_member = $request->team_member;
            $data->file_name_doc = $document_url;
            $data->file_name_prop = $proposal_url;
            $data->proposal_url = $finalPathDoc;
            $data->document_url = $finalPathProp;

            $data->save();

            if($data == null){
                return response()->json([
                    'message' => 'somethings wrong'
                ],401);
            }

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Adding Data'
            ],200);

        } catch (\Throwable $th) {
            // throw $th;
        }
    }

    //Fungsi ini gunanya untuk mengupdate data InternalResearch pada Repositori InternalResearch
    public function update(Request $request,$id){
        try {
            $data = InternalResearch::find($id);
            if($data == null){
                return response()->json([
                    'message' => 'Data Not Found !'
                ],500);
            }

            //update data apabila menginputkan file di document_url
            if($request->hasFile('document_url')) {
                //digunakan untuk menghapus file beradasarkan id yang diinputkan
                Storage::disk('public')->delete('internalResearch/document/'.$data->file_name_doc);

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
                Storage::disk('public')->delete('internalResearch/proposal/'.$data->file_name_prop);

                //Upload Document
                $file_name = date('Ymd').preg_replace('/\s+/','_',$request->title);
                $pathNameProp = 'storage/thesisDocument/proposal/';
                $proposal_url = $file_name.'.'.$request->file('proposal_url')->extension();
                $request->file('proposal_url')->storeAs('internalResearch/proposal', $proposal_url, 'public');

                $finalPathProp = $pathNameProp . $proposal_url;

                $data->proposal_url = $finalPathProp;
            }


            $data->users_id = $request->users_id;
            $data->title = $request->title;
            $data->abstract = $request->abstract;
            $data->budget_type = $request->budget_type;
            $data->budget = $request->budget;
            $data->project_started_at = $request->project_started_at;
            $data->project_finish_at = $request->project_finish_at;
            $data->contract_number = $request->contract_number;
            $data->team_member = $request->team_member;
            $data->file_name_doc = $document_url;
            $data->file_name_prop = $proposal_url;

            $data->save();

            if($data == null){
                return response()->json([
                    'message' => 'somethings wrong'
                ],401);
            }

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Update Data'
            ],200);
        } catch (\Throwable $th) {
            // throw $th;
        }
    }

    //Fungsi ini gunanya untuk menghapus salah satu data pada repositori InternalResearch
    public function destroy($id){
        try {
            $query = InternalResearch::find($id);

            if($query == null){
                return response()->json([
                    'message' => 'Data Not Found !'
                ],500);
            }

            //digunakan untuk menghapus file beradasarkan id yang diinputkan
            Storage::disk('public')->delete('internalResearch/document/'.$query->file_name_doc);
            Storage::disk('public')->delete('internalResearch/proposal/'.$query->file_name_prop);

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
