<?php

namespace App\Http\Controllers\Web\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisDocument;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class ThesisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = Thesis::find($id)->with('User')->first();
        $document = ThesisDocument::where('thesis_id', $id)->get();
        // var_dump($data);
        return view('thesis.index',compact('data', 'document'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        $thesis_type = $type;
        // $users = User::all();
        // var_dump($thesis_type);
        return view('thesis.add')->with(compact('thesis_type'));
    }
    /**
     * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'thesis_type' => 'required',
            'title' => 'required',
            'abstract' => 'required',
            'tags' => 'required'
            'created_year' => 'required',
        ]);

        $thumnail_url = 'img/design/background.png';
        if ($request->hasFile('thumbnail_url')){
            $file_name = rand().date('YmdHis');
            $thumnail_url = $file_name.'.'.$request->file('thumbnail_url')->extension();
            $request->file('thumbnail_url')->storeAs('img/thumbnail', $thumnail_url, 'public');
        }
        
        try {
            $thumbnail = $request->file('thumbnail_url');
            $thumbnail_name = strtolower($request->title)."-img-thumbnail.".$thumbnail->getClientOriginalExtension();
            Thesis::create([
                'users_id' => Auth::user()->id,
                'thesis_type' => $request->thesis_type,
                'thumbnail_url' => 'img/thesis/thumbnail/'.$thumbnail_name,
                'title' => $request->title,
                'tags' => $request->tags,
                'abstract' => $request->abstract,
                'created_year' => $request->created_year,
            ]);
            
            //move digunakan untuk memindahkan file ke folder public lalu dilanjutkan ke folder yang telah ditentukan
            $thumbnail->move('img/thesis/thumbnail/',$thumbnail_name);
            
            return redirect()->route('repository.index');

        } catch (\Throwable $th) {
            var_dump($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thesis = Thesis::find($id);
        $users = User::all();
        return view('admin.departement.edit')->with(compact('thesis','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data=Thesis::find($id);
            $update = [
                'users_id' => $request->users_id,
                'thesis_type' => $request->thesis_type,
                'thumbnail_url' => $request->thumbnail_url,
                'title' => $request->title,
                'abstract' => $request->abstract,
                'created_year' => $request->created_year,
            ];

            if($request->file('thumbnail_url') !== NULL){
                $thumbnail = $request->file('thumbnail_url');
                $thumbnail_name = strtolower($request->title)."-img-thumbnail.".$thumbnail->getClientOriginalExtension();
                $update = [
                    'thumbnail_url' => 'img/thesis/thumbnail/'.$thumbnail_name,
                ];

                unlink($data['thumbnail_url']);
                //move digunakan untuk memindahkan file ke folder public lalu dilanjutkan ke folder img/internalResearch/thumbnail
                $thumbnail->move('img/thesis/thumbnail/',$thumbnail_name);
            }

            Thesis::find($id)->update($update);
            return redirect()->route('departements.index');

        } catch (\Throwable $th) {
            // return $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = Thesis::find($id);
            unlink($data['thumbnail_url']);
            $data = Thesis::destroy($id);
            return redirect()->route('admin.departements.index');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
