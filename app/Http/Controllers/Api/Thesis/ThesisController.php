<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use Illuminate\Http\Request;

class ThesisController extends Controller
{
    //


    public function getAllThesis(){
        $data = Thesis::with([
            // Nama Relasi yang akan dipakai
            'user',
        ])->get([
            // Field yang akan dipakai
            'id',
            'tags',
        ]);
       
        // }
        return response()->json([
            'data' => $data
        ]);
    }

    
}
