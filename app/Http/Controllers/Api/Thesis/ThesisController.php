<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use Illuminate\Http\Request;

class ThesisController extends Controller
{
    
    /**
     * Update the specified user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */

    public function getThesis(){
        $search = 'lama';
        $data = Thesis::query()->when($search,function($query) use ($search){
            $query->where('title','like','%'.$search.'%');
        })->with('user')->get();
        return response()->json([
            'data' => $data
        ]);
    }

    
}
