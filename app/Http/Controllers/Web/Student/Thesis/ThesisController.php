<?php

namespace App\Http\Controllers\Web\Student\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisDocument;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class ThesisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $thesis_type = $request->type;
        // $users = User::all();
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
            'tags' => 'required',
            'created_year' => 'required',
        ]);

        try {
            Thesis::create([
                'users_id' => Auth::user()->id,
                'thesis_type' => $request->thesis_type,
                'title' => $request->title,
                'tags' => $request->tags,
                'abstract' => $request->abstract,
                'created_year' => $request->created_year,
            ]);

            return redirect()->route('studentRepository.index');

        } catch (\Throwable $th) {
            // throw $th;
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
        $thesis = Thesis::where('id', $id)->with('users')->first();
        $document = ThesisDocument::where('thesis_id', $id)->get();
        return view('thesis.index',compact('thesis', 'document'));
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
        return view('thesis.edit')->with(compact('thesis'));
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
            Thesis::where('id', $id)->update([
                'title' => $request->title,
                'abstract' => $request->abstract,
                'created_year' => $request->created_year,
                'tags' => $request->tags,
            ]);

            return redirect('/mahasiswa/thesis/'.$id);

        } catch (\Throwable $th) {
            var_dump($th);
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
            $data = ThesisDocument::where('thesis_id', $id)->get();
            foreach ($data as $item){
                Storage::disk('public')->delete(str_replace('storage/', '', $item->document_url));
            }
            Thesis::destroy($id);
            return redirect()->route('studentRepository.index');

        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
