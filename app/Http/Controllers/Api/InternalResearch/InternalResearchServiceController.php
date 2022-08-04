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
                'thumbnail_url' => 'required',
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

            //request untuk menguload dalam bentuk file
            $thumbnail = $request->file('thumbnail_url');
            $proposal = $request->file('proposal_url');
            $document = $request->file('document_url');

            //request untuk mengubah nama file berdasarkan judul atau title internal research pada strtolower($request->title)
            //selanjutnya ditambah nama -img-thumbnail dan tambahan format asli pada file tersebut seperti .pdf, .png dll
            //getClientOriginalExtension digunakan untuk mencari format asli pada file
            $thumbnail_name = strtolower($request->title)."-img-thumbnail.".$thumbnail->getClientOriginalExtension();
            $proposal_name = strtolower($request->title)."-file-proposal.".$proposal->getClientOriginalExtension();
            $document_name = strtolower($request->title)."-file-document.".$document->getClientOriginalExtension();


            $data = new InternalResearch();
            $data->users_id = $request->users_id;
            $data->title = $request->title;
            $data->abstract = $request->abstract;
            $data->thumbnail_url = $thumbnail_name;
            $data->budget_type = $request->budget_type;
            $data->budget = $request->budget;
            $data->project_started_at = $request->project_started_at;
            $data->project_finish_at = $request->project_finish_at;
            $data->contract_number = $request->contract_number;
            $data->team_member = $request->team_member;
            $data->proposal_url = $proposal_name;
            $data->document_url = $document_name;

            //move digunakan untuk memindahkan file ke folder public lalu dilanjutkan ke folder yang telah ditentukan
            $thumbnail->move('img/internalResearch/thumbnail/',$thumbnail_name);
            $proposal->move('files/internalResearch/',$proposal_name);
            $document->move('files/internalResearch/',$document_name);

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

            //fungsi ini untuk update yang berjalan saat field thumbnail_url tidak kosong
            if($request->file('thumbnail_url') !== NULL){

                //unlink digunakan untuk mengahpus file local pada folder yang sudah ditentukan
                unlink('img/internalResearch/thumbnail/'.$data['thumbnail_url']);

                $thumbnail = $request->file('thumbnail_url');
                $thumbnail_name = strtolower($request->title)."-img-thumbnail.".$thumbnail->getClientOriginalExtension();

                $data->thumbnail_url = $thumbnail_name;

                //move digunakan untuk memindahkan file ke folder public lalu dilanjutkan ke folder img/internalResearch/thumbnail
                $thumbnail->move('img/internalResearch/thumbnail/',$thumbnail_name);
            }

            if($request->file('proposal_url') !== NULL){

                //unlink digunakan untuk mengahpus file local pada folder yang sudah ditentukan
                unlink('files/internalResearch/'.$data['proposal_url']);

                $proposal = $request->file('proposal_url');
                $proposal_name = strtolower($request->title)."-file-proposal.".$proposal->getClientOriginalExtension();

                $data->proposal_url = $proposal_name;

                $proposal->move('files/internalResearch/',$proposal_name);
            }

            if($request->file('document_url') !== NULL){

                //unlink digunakan untuk mengahpus file local pada folder yang sudah ditentukan
                unlink('files/internalResearch/'.$data['document_url']);

                $document = $request->file('document_url');
                $document_name = strtolower($request->title)."-file-document.".$document->getClientOriginalExtension();

                $data->document_url = $document_name;

                $document->move('files/internalResearch/',$document_name);
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

            //unlink digunakan untuk mengahpus file local pada folder yang sudah ditentukan
            unlink('img/internalResearch/thumbnail/'.$query['thumbnail_url']);
            unlink('files/internalResearch/'.$query['proposal_url']);
            unlink('files/internalResearch/'.$query['document_url']);

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
