<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\ThesisDocument;
use Illuminate\Http\Request;

class ThesisDocumentServiceController extends Controller
{
    //function ini digunakan untuk mengambil dan mencari data dari repositori thesis document
    public function getThesisDocument(Request $request)
    {
        $search = request('search','');
        $data = ThesisDocument::query()->when($search , function($query) use ($search){
            $query->where('document_name','like','%' . $search . '%');
        })->get();

        return response()->json([
            'search_keyword' => $search,
            'data' => $data
        ],200);
    }
    //function ini digunakan untuk mengambil satu data dari repositori thesis document dengan mengambil salah satu idnya
    public function getOneThesisDocument(Request $request, $id)
    {
        $data = ThesisDocument::where('id',$id)->with('thesis')->first();
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

    //Fungsi ini gunanya untuk menambah data thesis document pada Repositori thesis
    public function create(Request $request){

        try {
            $validate = Validator($request->all(),[
                'thesis_id' => 'required',
                'document_name' => 'required',
                'url' => 'required'
            ]);

            if($validate->fails()){
                return response()->json([
                    'validate' => $validate->errors()
                ]);
            }

            //create request and name for file pdf
            $pdf = $request->file('url');
            $pdf_name = strtolower($request->document_name)."-file-thesis.".$pdf->getClientOriginalExtension();

            $data = new ThesisDocument();
            $data->thesis_id = $request->thesis_id;
            $data->document_name = $request->document_name;
            $data->url = $pdf_name;

            //move file pdf to file public/files/thesis
            $pdf->move('files/thesis/',$pdf_name);

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Adding Data'
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    //Fungsi ini gunanya untuk mengupdate data thesis document pada Repositori thesis
    public function update(Request $request,$id){
        try {
            $data = ThesisDocument::find($id);
            if($data == null){
                return response()->json([
                    'message' => 'Data Not Found !'
                ],500);
            }

            if ($request->file('url')!=NULL) {
                unlink('files/thesis/'.$data['url']);
                $pdf = $request->file('url');
                $pdf_name = strtolower($request->document_name)."-file-thesis.".$pdf->getClientOriginalExtension();

                $data->url = $pdf_name;

                $pdf->move('files/thesis/',$pdf_name);
            }

            $data->thesis_id = $request->thesis_id;
            $data->document_name = $request->document_name;

            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Update Data'
            ],200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    //Fungsi ini gunanya untuk menghapus salah satu data pada repositori thesis document
    public function destroy($id){
        try {
            $query = ThesisDocument::find($id);
            unlink('files/thesis/'.$query['url']);
            if($query == null){
                return response()->json([
                    'message' => 'Data Not Found !'
                ],500);
            }
            unlink('files/thesis/'.$query['url']);
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
}
