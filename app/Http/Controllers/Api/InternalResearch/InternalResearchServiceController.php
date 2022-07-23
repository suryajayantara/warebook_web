<?php

namespace App\Http\Controllers\Api\InternalResearch;

use App\Http\Controllers\Controller;
use App\Models\InternalResearch;
use Illuminate\Http\Request;

class InternalResearchServiceController extends Controller
{
    //function ini digunakan untuk mengambil dan mencari data dari repositori InternalResearch
    public function getResearch(Request $request)
    {
        $search = request('search','');
        $data = InternalResearch::query()->when($search , function($query) use ($search){
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
        $data = InternalResearch::find($id);
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
                'thumbnail_url' => 'required',
                'budget_type' => 'required',
                'budget' => 'required',
                'project_started_at' => 'required',
                'project_finish_at' => 'required',
                'contract_number' => 'required',
                'team_member' => 'required',
                'contract_url' => 'required',
                'proposal_url' => 'required',
                'document_url' => 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'validate' => $validate->errors()
                ]);
            }

            $data = new InternalResearch();
            $data->users_id = $request->users_id;
            $data->title = $request->title;
            $data->abstract = $request->abstract;
            $data->thumbnail_url = $request->thumbnail_url;
            $data->budget_type = $request->budget_type;
            $data->budget = $request->budget;
            $data->project_started_at = $request->project_started_at;
            $data->project_finish_at = $request->project_finish_at;
            $data->contract_number = $request->contract_number;
            $data->team_member = $request->team_member;
            $data->contract_url = $request->contract_url;
            $data->proposal_url = $request->proposal_url;
            $data->document_url = $request->document_url;

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

            $data->users_id = $request->users_id;
            $data->title = $request->title;
            $data->abstract = $request->abstract;
            $data->thumbnail_url = $request->thumbnail_url;
            $data->budget_type = $request->budget_type;
            $data->budget = $request->budget;
            $data->project_started_at = $request->project_started_at;
            $data->project_finish_at = $request->project_finish_at;
            $data->contract_number = $request->contract_number;
            $data->team_member = $request->team_member;
            $data->contract_url = $request->contract_url;
            $data->proposal_url = $request->proposal_url;
            $data->document_url = $request->document_url;

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
