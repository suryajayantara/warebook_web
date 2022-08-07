<?php

namespace App\Http\Controllers\Api\StudentCreativityProgram;

use App\Http\Controllers\Controller;
use App\Models\StudentCreativityProgram;
use Illuminate\Http\Request;

class StudentCreativityProgramServiceController extends Controller
{
    //function ini digunakan untuk mengambil dan mencari data dari repositori PKM
    public function getCreativity(Request $request)
    {
        $search = request('search','');
        $data = StudentCreativityProgram::query()->when($search , function($query) use ($search){
            $query->where('title','like','%' . $search . '%');
        })->get();

        return response()->json([
            'search_keyword' => $search,
            'data' => $data
        ],200);
    }
    //function ini digunakan untuk mengambil satu data dari repositori PKM dengan mengambil salah satu idnya
    public function getOneCreativity(Request $request, $id)
    {
        $data = StudentCreativityProgram::where('id',$id)->with('creativityType')->first();
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

    //Fungsi ini gunanya untuk menambah data PKM pada Repositori PKM
    public function create(Request $request){

        try {
            $validate = Validator($request->all(),[
                'users_id' => 'required',
                'creativity_type' => 'required',
                'aliases' => 'required',
                'title' => 'required',
                'abstract' => 'required',
                'year' => 'required',
                'supervisor' => 'required',
                'document_url' => 'required',
            ]);

            if($validate->fails()){
                return response()->json([
                    'validate' => $validate->errors()
                ]);
            }

            //request untuk menguload dalam bentuk file
            $document = $request->file('document_url');

            //request untuk mengubah nama file berdasarkan judul atau title internal research pada strtolower($request->title)
            //selanjutnya ditambah nama -img-thumbnail dan tambahan format asli pada file tersebut seperti .pdf, .png dll
            //getClientOriginalExtension digunakan untuk mencari format asli pada file
            $document_name = strtolower($request->title)."-file-document.".$document->getClientOriginalExtension();


            $data = new StudentCreativityProgram();
            $data->users_id = $request->users_id;
            $data->creativity_type = $request->creativity_type;
            $data->aliases = $request->aliases;
            $data->title = $request->title;
            $data->abstract = $request->abstract;
            $data->year = $request->year;
            $data->supervisor = $request->supervisor;
            $data->document_url = $document_name;

            $document->move('files/creativity/',$document_name);

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Adding Data'
            ],200);
        } catch (\Throwable $th) {
            throw $th;
        }

    }

    //Fungsi ini gunanya untuk mengupdate data PKM pada Repositori PKM
    public function update(Request $request,$id){
        try {
            $data = StudentCreativityProgram::find($id);
            if($data == null){
                return response()->json([
                    'message' => 'Data Not Found !'
                ],500);
            }

            if($request->file('document_url') !== NULL){

                unlink('files/creativity/'.$data['document_url']);

                $document = $request->file('document_url');
                $document_name = strtolower($request->title)."-file-document.".$document->getClientOriginalExtension();

                $data->document_url = $document_name;

                $document->move('files/creativity/',$document_name);
            }

            $data->users_id = $request->users_id;
            $data->creativity_type = $request->creativity_type;
            $data->aliases = $request->aliases;
            $data->title = $request->title;
            $data->abstract = $request->abstract;
            $data->year = $request->year;
            $data->supervisor = $request->supervisor;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Update Data'
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    //Fungsi ini gunanya untuk menghapus salah satu data pada repositori PKM
    public function destroy($id){
        try {
            $query = StudentCreativityProgram::find($id);
            unlink('files/creativity/'.$query['document_url']);
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
