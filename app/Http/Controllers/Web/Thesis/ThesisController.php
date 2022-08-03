<?php

namespace App\Http\Controllers\Web\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisDocument;
use App\Models\User;
use Illuminate\Http\Request;

class ThesisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Thesis::all();
        return view('admin.study.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.departement.add')->with(compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'users_id' => 'required',
            'thesis_type' => 'required',
            'thumbnail_url' => 'required',
            'title' => 'required',
            'abstract' => 'required',
        ]);

        try {
            $thumbnail = $request->file('thumbnail_url');
            $thumbnail_name = strtolower($request->title)."-img-thumbnail.".$thumbnail->getClientOriginalExtension();
            Thesis::create([
                'users_id' => $request->users_id,
                'thesis_type' => $request->thesis_type,
                'thumbnail_url' => 'img/thesis/thumbnail/'.$thumbnail_name,
                'title' => $request->title,
                'abstract' => $request->abstract
            ]);

            //move digunakan untuk memindahkan file ke folder public lalu dilanjutkan ke folder yang telah ditentukan
            $thumbnail->move('img/thesis/thumbnail/',$thumbnail_name);

            return redirect()->route('departements.index');

        } catch (\Throwable $th) {
            // return $th;
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
            $update = [
                'users_id' => $request->users_id,
                'thesis_type' => $request->thesis_type,
                'thumbnail_url' => $request->thumbnail_url,
                'title' => $request->title,
                'abstract' => $request->abstract
            ];

            if($request->file('thumbnail_url') !== NULL){
                $thumbnail = $request->file('thumbnail_url');
                $thumbnail_name = strtolower($request->title)."-img-thumbnail.".$thumbnail->getClientOriginalExtension();
                $update = [
                    'thumbnail_url' => 'img/thesis/thumbnail/'.$thumbnail_name,
                ];

                Thesis::find($id)->update($update);

                //move digunakan untuk memindahkan file ke folder public lalu dilanjutkan ke folder img/internalResearch/thumbnail
                $thumbnail->move('img/thesis/thumbnail/',$thumbnail_name);
            }

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
