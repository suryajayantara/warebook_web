<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use Illuminate\Http\Request;

class ThesisController extends Controller
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
        $data = Thesis::find($id)->with('documents')->first();
        return response()->json([
            'data' => $data
        ],200);
    }

    public function create(Request $request){
        return response()->json([
            'data' => $request->data
        ],200);
    }

    public function update(Request $request,$id){
        // 
    }

    public function destroy($id){
        try {
            $query = Thesis::find($id);
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
            throw $th;
        }
        
    }

    // Start new Function HERE 

   
}
