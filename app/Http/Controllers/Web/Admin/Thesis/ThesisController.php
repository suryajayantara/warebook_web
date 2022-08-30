<?php

namespace App\Http\Controllers\Web\Admin\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ThesisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Thesis::paginate(5);
        return view('admin.thesis.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.thesis.add');
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
            'author' => 'required',
        ]);

        try {
            Thesis::create([
                'users_id' => Auth::user()->id,
                'thesis_type' => $request->thesis_type,
                'title' => $request->title,
                'tags' => $request->tags,
                'abstract' => $request->abstract,
                'created_year' => $request->created_year,
                'author' => $request->author
            ]);

            return redirect()->route('manageThesis.index');
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
    public function show(Request $request)
    {
        $data = Thesis::where('title', 'LIKE', '%' . $request->search . '%')->orWhere('thesis_type', 'LIKE', '%' . $request->search . '%')->orWhere('tags', 'LIKE', '%' . $request->search . '%')->paginate(6);
        return view('admin.thesis.index', compact('data'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Thesis::find($id);
        return view('admin.thesis.edit')->with(compact('data'));
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
                'thesis_type' => $request->thesis_type,
                'title' => $request->title,
                'abstract' => $request->abstract,
                'created_year' => $request->created_year,
                'tags' => $request->tags,
            ]);

            return redirect()->route('manageThesis.index');
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
            foreach ($data as $item) {
                Storage::disk('public')->delete(str_replace('storage/', '', $item->document_url));
            }
            Thesis::destroy($id);
            return redirect()->route('manageThesis.index');
        } catch (\Throwable $th) {
            echo 'gagal';
        }
    }
}
