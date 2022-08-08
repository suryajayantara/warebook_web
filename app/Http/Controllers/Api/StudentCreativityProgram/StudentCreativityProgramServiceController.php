<?php

namespace App\Http\Controllers\Api\StudentCreativityProgram;

use App\Http\Controllers\Controller;
use App\Models\StudentCreativityProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentCreativityProgramServiceController extends Controller
{
    //function ini digunakan untuk mengambil dan mencari data dari repositori PKM
    public function getCreativity(Request $request)
    {
        $search = request('search', '');
        $data = StudentCreativityProgram::query()->with('users')->when($search, function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        })->get();

        return response()->json([
            'search_keyword' => $search,
            'data' => $data
        ], 200);
    }
    //function ini digunakan untuk mengambil satu data dari repositori PKM dengan mengambil salah satu idnya
    public function getOneCreativity(Request $request, $id)
    {
        $data = StudentCreativityProgram::where('id', $id)->with('creativityType')->first();
        if ($data == null) {
            return response()->json([
                'message' => 'Data Not Found !'
            ], 500);
        } else {
            return response()->json([
                'data' => $data
            ], 200);
        }
    }

    //Fungsi ini gunanya untuk menambah data PKM pada Repositori PKM
    public function create(Request $request)
    {

        try {
            // Check apakah user sudah login atau belum
            if(!auth('api')->check()){
                return response()->json([
                    'message' => 'Anda Belum Login',
                ],401);
            }

            // Data dari Token , Disimpan di variable ini
            $user = auth()->guard('api')->user();

            $validate = Validator($request->all(), [
                'creativity_type' => 'required',
                'aliases' => 'required',
                'title' => 'required',
                'abstract' => 'required',
                'year' => 'required',
                'supervisor' => 'required',
                'document_url' => 'required',
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'validate' => $validate->errors()
                ]);
            }

            //Upload Document
            $file_name = date('Ymd') . preg_replace('/\s+/', '_', $request->title);
            $pathName = 'storage/studentCreativityProgram/';
            $document_url = $file_name . '.' . $request->file('document_url')->extension();
            $request->file('document_url')->storeAs('studentCreativityProgram', $document_url, 'public');

            $finalPath = $pathName . $document_url;

            $data = new StudentCreativityProgram();
            $data->users_id = $user->id;
            $data->creativity_type = $request->creativity_type;
            $data->aliases = $request->aliases;
            $data->title = $request->title;
            $data->abstract = $request->abstract;
            $data->year = $request->year;
            $data->supervisor = $request->supervisor;
            $data->document_url = $finalPath;
            $data->save();

            return response()->json([
                'data' => $data,
                'message' => 'Succesful Adding Data'
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //Fungsi ini gunanya untuk mengupdate data PKM pada Repositori PKM
    public function update(Request $request, $id)
    {
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
            $data = StudentCreativityProgram::find($id);
            if ($data == null) {
                return response()->json([
                    'message' => 'Data Not Found !'
                ], 500);
            }

            //update data apabila menginputkan file di document_url
            if ($request->hasFile('document_url')) {
                //digunakan untuk menghapus file beradasarkan id yang diinputkan
                Storage::disk('public')->delete(str_replace('storage/', '', $data->document_url));

                $file_name = date('Ymd') . preg_replace('/\s+/', '_', $request->title);
                $pathName = 'storage/studentCreativityProgram/';
                $document_url = $file_name . '.' . $request->file('document_url')->extension();
                $request->file('document_url')->storeAs('studentCreativityProgram', $document_url, 'public');

                $finalPath = $pathName . $document_url;

                $data->document_url = $finalPath;
            }

            $data->users_id = $user->id;
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
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //Fungsi ini gunanya untuk menghapus salah satu data pada repositori PKM
    public function destroy($id)
    {
        try {
            $query = StudentCreativityProgram::find($id);
            if ($query == null) {
                return response()->json([
                    'message' => 'Data Not Found !'
                ], 500);
            }

            //digunakan untuk menghapus file beradasarkan id yang diinputkan
            Storage::disk('public')->delete(str_replace('storage/', '', $query->document_url));

            $query->delete();
            if ($query) {
                return response()->json([
                    'message' => 'Successful Deleting Data !'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data Not Deleted'
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // Start new Function HERE
}
